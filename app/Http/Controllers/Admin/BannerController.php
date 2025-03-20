<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.banners.';
    const PATH_UPLOAD = 'banners';
    public function index()
    {
        $banners = MarketingBanner::all();
        return view(self::PATH_VIEW . __FUNCTION__,  compact('banners'));
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
            'title' => ['required', 'max:50'],
            'url' => ['required'],
            'image_url' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'description' => ['required', 'min:20'],
        ]);

        try {
            $data = $validated;

            
            if ($request->hasFile('image_url')) {
                $data['image_url'] = Storage::put(self::PATH_UPLOAD, $request->file('image_url'));
            }
            MarketingBanner::query()->create($data);

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
        $banners = MarketingBanner::find($id);
        return view(self::PATH_VIEW . __FUNCTION__,  compact('banners'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banners = MarketingBanner::find($id);
        return view(self::PATH_VIEW . __FUNCTION__,  compact('banners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:50'],
            'url' => ['required'],
            'image_url' => ['image', 'mimes:jpeg,png,jpg,gif,svg'],
            'description' => ['required', 'min:20'],
        ]);
    
        try {
            DB::beginTransaction();
            $model = MarketingBanner::query()->findOrFail($id);
    
            // Khởi tạo mảng $data với các giá trị đã validate
            $data = $validated;
    
            // Xử lý icon
           
    
            // Xử lý image
            if ($request->hasFile('image_url')) 
            {
                $data['image_url'] = Storage::put(self::PATH_UPLOAD, $request->file('image_url'));
                $oldImage = $model->image_url;
            } else 
            {
                $oldImage = null;
            }
    
            // Cập nhật model với các giá trị trong mảng $data
            $model->update($data);
          
            // Xóa các tệp tin cũ nếu có
            
            if ($oldImage && Storage::exists($oldImage)) 
            {
                Storage::delete($oldImage);
            }
    
            DB::commit();
    
            return redirect()->route(self::PATH_VIEW.'index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', 'Cập nhật thất bại: ' );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    { 
        $model = MarketingBanner::query()->findOrFail($id);

        $model->delete();
        
        if ($model->image_url && Storage::exists($model->image_url)) {
            Storage::delete($model->image_url);
        }

        return back()->with('success', 'Xoá thành công');
        
    }
}
