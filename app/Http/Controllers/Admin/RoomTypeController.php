<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Promotion;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.room_types.';
    const PATH_UPLOAD = 'room_types';
    public function index()
    {
        $roomTypes = RoomType::with('amenities')->latest('id')->cursorPaginate(5);
        return view(self::PATH_VIEW . __FUNCTION__, compact('roomTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $promotions = Promotion::all();
        $amenities = Amenity::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('promotions', 'amenities'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50'],
            'image_thumbnail' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'price' => ['required', 'integer'],
            'people_amount' => ['required', 'integer'],
            'bed_amount' => ['required', 'integer'],
            'description' => ['required', 'min:20'],
            'amenities' => ['required', 'array'], // Validate array
            'amenities.*' => ['exists:amenities,id'], // Validate each amenity ID
        ]);

        DB::beginTransaction();

        try {
            $data = $validated;
            $data['is_active'] = $request->boolean('is_active', false);

            if ($request->hasFile('image_thumbnail')) {
                $data['image_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('image_thumbnail'));
            }

            // Tạo RoomType
            $roomType = RoomType::query()->create($data);

            // Gắn tiện nghi vào RoomType
            $roomType->amenities()->sync($validated['amenities']);

            DB::commit();

            return redirect()
                ->route(self::PATH_VIEW . 'index')
                ->with('success', 'Thêm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Thêm không thành công: ');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = RoomType::with('amenities')->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = RoomType::with('amenities')->findOrFail($id);
        $amenities = Amenity::all();
        // $room_type_hotel = $data->hotel()->pluck('id')->toArray();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data','amenities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50'],
            'image_thumbnail' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            'price' => ['required', 'integer'],
            'people_amount' => ['required', 'integer'],
            'bed_amount' => ['required', 'integer'],
            'description' => ['required', 'min:20'],
            'amenities' => ['required', 'array'], // Validate array
            'amenities.*' => ['exists:amenities,id'], // Validate each amenity ID
        ]);
    
        DB::beginTransaction();
    
        try {
            $model = RoomType::query()->findOrFail($id);
    
            $data = $validated;
            $data['is_active'] = $request->boolean('is_active', false);
    
            if ($request->hasFile('image_thumbnail')) {
                $data['image_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('image_thumbnail'));
                $oldImage = $model->image_thumbnail;
            } else {
                $oldImage = null;
            }
    
            $model->update($data); 
    
            // Cập nhật tiện nghi cho RoomType
            $model->amenities()->sync($validated['amenities']);
    
            if ($oldImage && Storage::exists($oldImage)) {
                Storage::delete($oldImage);
            }
    
            DB::commit();
    
            return redirect()
                ->route(self::PATH_VIEW . 'index')
                ->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Cập nhật không thành công: ' . $exception->getMessage());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Bắt đầu transaction để đảm bảo tính toàn vẹn của dữ liệu
        DB::beginTransaction();

        try {
            $model = RoomType::query()->findOrFail($id);

            // Xóa các tiện nghi liên quan trong bảng trung gian
            $model->amenities()->detach();

            // Xóa các phòng và hình ảnh liên quan
            foreach ($model->rooms as $room) {
                // Xóa các hình ảnh liên quan đến phòng
                foreach ($room->images as $image) {
                    // Xóa file hình ảnh nếu có
                    if ($image->image && Storage::exists($image->image)) {
                        Storage::delete($image->image);
                    }
                    $image->delete();
                }
                $room->delete();
            }

            // Xóa hình ảnh nếu có
            if ($model->image_thumbnail && Storage::exists($model->image_thumbnail)) {
                Storage::delete($model->image_thumbnail);
            }

            // Xóa RoomType
            $model->delete();

            // Hoàn thành transaction
            DB::commit();

            return back()->with('success', 'Xoá thành công');
        } catch (\Exception $exception) {
            // Rollback transaction nếu có lỗi
            DB::rollBack();
            return back()->with('error', 'Xoá không thành công: ' . $exception->getMessage());
        }
    }
}
