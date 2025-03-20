<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.promotions.';
    const PATH_UPLOAD = 'promotions';
    public function index()
    {
        $promotions = Promotion::query()->get();

        return response()->json(
            [
                'success' => true,
                'message' => 'Lấy dữ liệu thành công.',
                'data'=> $promotions
            ]
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
        try {
            DB::beginTransaction();
            $data = $request->all();

            Promotion::query()->create($data);

            DB::commit();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'RoomType created successfully.',
                    'data' => $data,
                ],
                201,
            );
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'RoomType created failed.',
                    
                ],
                500,
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $promotions = Promotion::findOrFail($id);
        return response()->json($promotions);
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $model = Promotion::query()->findOrFail($id);

            $data = $request->all();
            $data['is_active'] ??= 0;

            $model->update($data);

            DB::commit();

            return response()->json($model);
        } catch (\Exception $exception) {
            dd($exception->getMessage());

            return back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        
        try {
            // Tìm mã giảm giá với ID và xóa nó
            $model = Promotion::query()->findOrFail($id);

            $model->delete();
    
            
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Xoá mã giảm giá thành công.',
                ],
                200,
            );
        } catch (ModelNotFoundException $e) {
            // Xử lý lỗi khi không tìm thấy mã giảm giá
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Mã giảm giá không tồn tại.',
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
