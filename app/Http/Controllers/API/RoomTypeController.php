<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

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
        
        $roomTypes = RoomType::query()->get();;
        return response()->json(
            [
                'success' => true,
                'message' => 'RoomTypes retrieved successfully.',
                'data' => $roomTypes,
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
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['is_active'] ??= 0;

            RoomType::query()->create($data);

            DB::commit();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'RoomTypes created successfully.',
                    'data' => $data,
                ],
                201,
            );
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            // Tìm phòng theo ID với quan hệ 'roomType'
            $data = RoomType::with('amenities')->findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Room Type not found.' . $e->getMessage(),
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
        try {
            DB::beginTransaction();
            $model = RoomType::query()->findOrFail($id);

            $data = $request->all();
            $data['is_active'] ??= 0;
    
            $model->update($data);


            DB::commit();
    
            return redirect()->route('admin.room_types.index')->with('success', 'Cập nhật thành công');

        }catch (\Exception $exception) {    

            dd($exception->getMessage());

            return back()->with('error', 'Cập nhật thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = RoomType::query()->findOrFail($id);
        
        $model->delete();

        return back()->with('success', 'Xoá thành công');
    }
}