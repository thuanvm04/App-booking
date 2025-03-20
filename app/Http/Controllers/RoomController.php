<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index($id)
    {
        $room_types = RoomType::with(['rooms' => function($query) {
            $query->where('availability_status', 1);
        }, 'amenities'])
        ->where('is_active', 1)
        ->findOrFail($id);
        
        // $room = Room::with('roomType')->get();
        return view('client.room_types',compact('room_types'));
    }
    public function roomDetail($id){
        
        $room = Room::with(['roomType.amenities','images'])
        ->where(['is_active' => 1, 'availability_status' => 1])
        ->findOrFail($id);

        return view('client.room_details',compact('room'));
    }   
}
