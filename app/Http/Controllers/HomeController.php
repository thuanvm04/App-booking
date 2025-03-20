<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Booking;
use App\Models\MarketingBanner;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $amenity = Amenity::limit(4)->get();
        $banners = MarketingBanner::all();

        $RoomTypes = RoomType::all();
        $booking = Booking::with('room')
            ->where(function ($query) {
                $query->where('check_out_date', '>', date('Y-m-d'))->orWhere('check_in_date', '<', date('Y-m-d'));
            })
            ->get();
        // dd($booking);
        return view('client.home', compact('amenity', 'banners', 'RoomTypes','booking'));
    }
    public function master()
    {
        // $amenities = Amenity::all();
        // return view('client.layouts.master',compact('amenities'));
    }
}
