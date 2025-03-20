<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.rooms.';
    const PATH_UPLOAD = 'rooms';
    public function index()
    {
        $rooms = Room::query()
            ->with(['roomType'])
            ->latest('id')
            ->cursorPaginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomTypes = DB::table('room_types')->where('is_active', 1)->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'image_thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'price' => ['required', 'integer'],

            'description' => ['required', 'min:20'],
        ]);

        $dataRoomImages = $request->file('room_images') ?: [];
        try {
            DB::beginTransaction();
            $data = $validated;
            $data['availability_status'] = $request->boolean('availability_status', false);
            $data['is_active'] = $request->boolean('is_active', false);

            if ($request->hasFile('image_thumbnail')) {
                $data['image_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('image_thumbnail'));
            }
            $rooms = Room::query()->create($data);
            foreach ($dataRoomImages as $key => $image) {
                RoomImage::query()->create([
                    'room_id' => $rooms->id,
                    'image' => $image->store('rooms'),
                ]);
            }
            // dd();

            DB::commit();

            return redirect()
                ->route(self::PATH_VIEW . 'index')
                ->with('success', 'Thêm thành công ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Room::query()->findOrFail($id);
        $room_types = DB::table('room_types')->where('is_active', 1)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'room_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50'],
            'room_type_id' => ['required', 'exists:room_types,id'],
            'image_thumbnail' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            'price' => ['required', 'integer'],
            'description' => ['required', 'min:20'],
        ]);
        $dataRoomImages = $request->file('room_images') ?: [];
        try {
            DB::beginTransaction();
            $model = Room::query()->findOrFail($id);

            $data = $validated;
            $data['availability_status'] = $request->boolean('availability_status', false);
            $data['is_active'] = $request->boolean('is_active', false);

            if ($request->hasFile('image_thumbnail')) {
                // Lưu ảnh mới và cập nhật đường dẫn vào $data
                $data['image_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('image_thumbnail'));

                // Lưu lại đường dẫn ảnh hiện tại để xóa sau khi cập nhật thành công
                $currentImage = $model->image_thumbnail;
            } else {
                // Không có ảnh mới, giữ nguyên ảnh hiện tại
                $currentImage = null;
            }

            $model->update($data);

            if ($currentImage && Storage::exists($currentImage)) {
                Storage::delete($currentImage);
            }

            // XỬ LÍ NHIỀU ẢNH

            // Lấy danh sách các ảnh hiện tại của phòng từ cơ sở dữ liệu
            $currentImages = RoomImage::where('room_id', $model->id)->get();

            // Xóa các ảnh được đánh dấu xóa
            if (isset($dataRoomImages['deleted_images'])) {
                foreach ($dataRoomImages['deleted_images'] as $imageId) {
                    $imageToDelete = RoomImage::find($imageId);
                    if ($imageToDelete) {
                        Storage::delete($imageToDelete->image); // Xóa ảnh khỏi storage
                        $imageToDelete->delete(); // Xóa ảnh khỏi cơ sở dữ liệu
                    }
                }
            }

            // Xử lý các ảnh hiện tại
            foreach ($currentImages as $currentImage) {
                $inputName = "room_images[{$currentImage->id}]";
                if (isset($dataRoomImages[$inputName]) && $dataRoomImages[$inputName] instanceof \Illuminate\Http\UploadedFile) {
                    // Nếu có ảnh mới, cập nhật ảnh mới
                    Storage::delete($currentImage->image); // Xóa ảnh cũ khỏi storage
                    $currentImage->image = $dataRoomImages[$inputName]->store('rooms'); // Lưu ảnh mới
                    $currentImage->save();
                }
            }

            // Thêm các ảnh mới vào cơ sở dữ liệu
            if (isset($dataRoomImages['new_room_images'])) {
                foreach ($dataRoomImages['new_room_images'] as $newImage) {
                    RoomImage::create([
                        'room_id' => $model->id,
                        'image' => $newImage->store('rooms'),
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route(self::PATH_VIEW . 'index')
                ->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            Log::error('Cập nhật thất bại: ' . $exception->getMessage());
            return back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Room::query()->findOrFail($id);
        // Lấy tất cả các ảnh liên quan đến phòng từ bảng room_images
        $images = RoomImage::where('room_id', $model->id)->get();

        // Xóa các ảnh khỏi storage và bảng room_images
        foreach ($images as $image) {
            if (Storage::exists($image->image)) {
                Storage::delete($image->image);
            }
            $image->delete();
        }
        $model->delete();

        if ($model->image && Storage::exists($model->image)) {
            Storage::delete($model->image);
        }

        return back()->with('success', 'Xoá thành công');
    }
}
