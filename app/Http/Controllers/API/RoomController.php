<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomStoreRequests;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
            ->get();
        // dd($rooms?->toArray());
        return response()->json(
            [
                'status' => true,
                'message' => 'Rooms retrieved successfully.',
                'data' => $rooms,
            ],
            200,
        );
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
            $request->validate([
                'name' => 'required',
                'image' => 'required',
                'room_type_id' => 'required',
            ]);
            $data = $request->except(['image']);
            $data['availability_status'] ??= 0;
            $data['is_active'] ??= 0;
            // Kiểm tra và xử lí room_type_id
            if ($request->filled('room_type_id')) {
                $roomType = RoomType::findOrFail($request->room_type_id);

                if (!$roomType) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Không thể tạo phòng với loại phòng không tồn tại.',
                        ],
                        422,
                    );
                }
                if ($roomType->is_active == 0) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Không thể tạo phòng với loại phòng không hoạt động.',
                        ],
                        500,
                    );
                }

                $data['room_type_id'] = $request->room_type_id;
            }
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }

            Room::query()->create($data);

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room created successfully.',
                    'data' => $data,
                ],
                201,
            );
      
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Tìm phòng theo ID với quan hệ 'roomType'
            $room = Room::with('images')->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $room,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Room not found.',
                ],
                404,
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        
        try {

            $request->validate([
                'name' => 'required',
                'image' => empty($request->image) ? null : $request->image,
                'room_type_id' => 'required',
            ]);

            $model = Room::findOrFail($id);

            $data = $request->except('image');

            // Thiết lập giá trị mặc định cho availability_status và is_active
            $data['availability_status'] ??= 0;
            $data['is_active'] ??= 0;

            // Kiểm tra và xử lí room_type_id
            if ($request->filled('room_type_id')) {
                $roomType = RoomType::findOrFail($request->room_type_id);

                if ($roomType->is_active == 0) {
                    return response()->json(
                        [
                            'success' => false,
                            'message' => 'Loại phòng không hoạt động.',
                        ],
                        500,
                    );
                }

                $data['room_type_id'] = $request->room_type_id;
            }

            if ($request->hasFile('image')) {
                // Lưu ảnh mới và cập nhật đường dẫn vào $data
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));

                // Lưu lại đường dẫn ảnh hiện tại để xóa sau khi cập nhật thành công
                $currentImage = $model->image;
            } else {
                // Không có ảnh mới, giữ nguyên ảnh hiện tại
                $currentImage = null;
            }

            $model->update($data);

            if ($currentImage && Storage::exists($currentImage)) {
                Storage::delete($currentImage);
            }

            DB::commit();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Room updated successfully.',
                    'data' => $model,
                ],
                200,
            );
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Room update failed.',
                    'error' => $exception->getMessage(),
                ],
                500,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Tìm phòng với ID và xóa nó
            $model = Room::findOrFail($id);

            $model->delete();
            if ($model->image && Storage::exists($model->image)) {
                Storage::delete($model->image);
            }

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Xoá phòng thành công.',
                ],
                200,
            );
        } catch (ModelNotFoundException $e) {
            // Xử lý lỗi khi không tìm thấy phòng
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Phòng không tồn tại.',
                ],
                404,
            );
        } catch (\Exception $e) {
            // Xử lý các lỗi khác
            return response()->json(
                [
                    'success' => false,
                    'message' => 'An error occurred while deleting the room.',
                ],
                500,
            );
        }
    }
}