<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.services.';
    const PATH_UPLOAD = 'services';
    public function index()
    {
        $services = Service::all();
        return view(self::PATH_VIEW . __FUNCTION__,  compact('services'));
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
            'name' => ['required', 'max:50'],
            'icon' => ['required',  'mimes:jpeg,png,jpg,gif,svg'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'price' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'min:20'],
        ]);
    
        try {
            $data = $validated;

            if ($request->hasFile('icon')) {
                $data['icon'] = Storage::put(self::PATH_UPLOAD, $request->file('icon'));
            }
            if ($request->hasFile('image')) {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
            }
            Service::query()->create($data);
           
            return redirect()->route( self::PATH_VIEW.'index')->with('success', 'Thêm thành công. ');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error','Thêm không thành công.');
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
        $data = Service::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:50'],
        
            'icon' => ['mimes:jpeg,png,jpg,gif,svg'],
            'image' => [ 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'price' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'min:20'],
        ]);
    
        try {
            DB::beginTransaction();
            $model = Service::query()->findOrFail($id);
    
            // Khởi tạo mảng $data với các giá trị đã validate
            $data = $validated;
    
            // Xử lý icon
            if ($request->hasFile('icon')) 
            { 
                $data['icon'] = Storage::put(self::PATH_UPLOAD, $request->file('icon'));

                $oldIcon = $model->icon;
            } else 
            {
                $oldIcon = null;
            }
    
            // Xử lý image
            if ($request->hasFile('image')) 
            {
                $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));

                $oldImage = $model->image;
            } else 
            {
                $oldImage = null;
            }
    
            // Cập nhật model với các giá trị trong mảng $data
            $model->update($data);
          
            // Xóa các tệp tin cũ nếu có
            if ($oldIcon && Storage::exists($oldIcon)) 
            {
                Storage::delete($oldIcon);
            }
            if ($oldImage && Storage::exists($oldImage)) 
            {
                Storage::delete($oldImage);
            }
    
            DB::commit();
    
            return redirect()->route(self::PATH_VIEW.'index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Cập nhật thất bại: ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $model = Service::query()->findOrFail($id);

        $model->delete();

        if ($model->icon && Storage::exists($model->icon)) {
            Storage::delete($model->icon);
        }
        if ($model->image && Storage::exists($model->image)) {
            Storage::delete($model->image);
        }

        return back()->with('success', 'Xoá thành công');
    }
}
