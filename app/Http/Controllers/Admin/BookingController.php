<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $rooms = Room::where(['is_active' => 1, 'availability_status' => 1])->get();
        
        return view(self::PATH_VIEW . __FUNCTION__, compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
                
            'check_in_date' => ['required','date'],
            'check_out_date' => ['required','date','after_or_equal:check_in_date'],
            'room_id' => ['required','exists:rooms,id'],
            'customer_id' => ['required','exists:customers,id'],
            'total_amount' => 'integer|required',
            

        ]);
        try{
           
            DB::beginTransaction();

            $data = $validated;
            $data['availability_status'] ??= 0;
            $data['is_active'] ??= 0;

            Booking::query()->create($data);

            DB::commit();

            return redirect()->route('admin.bookings.index')->with('success', 'Thêm thành công ');
        }catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookings= Booking::findOrFail($id);
        $rooms = Room::where(['is_active' => 1, 'availability_status' => 1])->get();
        
        return view(self::PATH_VIEW . __FUNCTION__, compact('bookings','rooms', 'customers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bookings= Booking::findOrFail($id);
        $rooms = Room::where(['is_active' => 1, 'availability_status' => 1])->get();
  
        return view(self::PATH_VIEW . __FUNCTION__, compact('bookings','rooms', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
                
            'check_in_date' => ['required','date'],
            'check_out_date' => ['required','date','after_or_equal:check_in_date'],
            'room_id' => ['required','exists:rooms,id'],
            'customer_id' => ['required','exists:customers,id'],
            'total_amount' => 'integer|required',
            

        ]);
        try {
           
            DB::beginTransaction();
            $model = Booking::query()->findOrFail($id);

            $data = $validated;
            $data['is_active'] ??= 0;
    
            $model->update($data);

            DB::commit();
    
            return redirect()->route('admin.bookings.index')->with('success', 'Cập nhật thành công');

        }catch (\Exception $exception) {    
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Booking::query()->findOrFail($id);

        $model->delete();

        return back()->with('success', 'Xoá thành công');
    }
}
