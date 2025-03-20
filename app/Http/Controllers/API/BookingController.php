<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.bookings.';
    const PATH_UPLOAD = 'bookings';
    public function index()
    {
        $data = Booking::query()
            ->with(['room', 'customer'])
            ->latest('id')
            ->get();
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::where(['is_active' => 1, 'availability_status' => 1])->get();
        $customers = Customer::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $data['availability_status'] ??= 0;
            $data['is_active'] ??= 0;

            Booking::query()->create($data);

            DB::commit();

            return redirect()->route('admin.bookings.index')->with('success', 'Thêm thành công ');
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
        $bookings= Booking::findOrFail($id);
        $rooms = Room::where(['is_active' => 1, 'availability_status' => 1])->get();
        $customers = Customer::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('bookings','rooms', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bookings= Booking::findOrFail($id);
        $rooms = Room::where(['is_active' => 1, 'availability_status' => 1])->get();
        $customers = Customer::all();
        return view(self::PATH_VIEW . __FUNCTION__, compact('bookings','rooms', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $model = Booking::query()->findOrFail($id);

            $data = $request->all();
            $data['is_active'] ??= 0;
    
            $model->update($data);

            DB::commit();
    
            return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật thành công');

        }catch (\Exception $exception) {    
            
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
        //
    }
}
