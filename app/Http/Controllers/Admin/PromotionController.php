<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Promotion;
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
        $promotions = Promotion::query()->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:30'],
            'discount_percentage' => ['required', 'integer', 'between:0,100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'description' => ['required', 'min:20'],
        ]);
        try {
            DB::beginTransaction();
            $data = $validated;

            Promotion::query()->create($data);

            DB::commit();

            return redirect()->route('admin.promotions.index')->with('success', 'Thêm thành công ');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Promotion::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:30'],
            'discount_percentage' => ['required', 'integer', 'between:0,100'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'description' => ['required', 'min:20'],
        ]);
        try {
            DB::beginTransaction();
            $model = Promotion::query()->findOrFail($id);

            $data = $validated;

            $model->update($data);

            DB::commit();

            return redirect()->route('admin.promotions.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {

            DB::rollBack();
            
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Promotion::query()->findOrFail($id);

        $model->delete();

        return back()->with('success', 'Xoá thành công');
    }
}
