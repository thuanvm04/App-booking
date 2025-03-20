<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.hotels.';
    const PATH_UPLOAD = 'hotels';
    public function index()
    {
        $data = Hotel::query()->paginate(10);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
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
        try {
            DB::beginTransaction();
            $data = $request->except(['image_thumbnail']);
            $data['is_active'] ??= 0;

            if ($request->hasFile('image_thumbnail')) {
                $data['image_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('image_thumbnail'));
            }
           
            $data['slug'] = str::slug($data['name']) . '-' . $data['sku'];
            Hotel::query()->create($data);

            DB::commit();

            return redirect()->route('admin.hotels.index')->with('success', 'Thêm thành công ');
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
        $data = Hotel::query()->findOrFail($id);
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $model = Hotel::query()->findOrFail($id);

            $data = $request->except('image_thumbnail');
            $data['is_active'] ??= 0;
    
            if ($request->hasFile('image_thumbnail')) {
                $data['image_thumbnail'] = Storage::put(self::PATH_UPLOAD, $request->file('image_thumbnail'));
            }
          
    
            $currentImage = $model->image_thumbnail;
    
            $model->update($data);
    
            if ($currentImage && Storage::exists($currentImage)) {
                Storage::delete($currentImage);
            }
            

            DB::commit();
    
            return redirect()->route('admin.hotels.index')->with('success', 'Cập nhật thành công');

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
        $model = Hotel::query()->findOrFail($id);
        
        $model->delete();
        
        if ($model->image_thumbnail && Storage::exists($model->image_thumbnail)) {
            Storage::delete($model->image_thumbnail);
        }

        return back()->with('success', 'Xoá thành công');
    }
}
