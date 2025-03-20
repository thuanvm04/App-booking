<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Service;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    public function amenity()
    {
        $amenities = Amenity::all();
        $services = Service::all();
        return view('client.amenity',compact('amenities','services'));
    }
    public function service()
    {
        $amenities = Amenity::all();
        $services = Service::all();
        return view('client.service',compact('amenities','services'));
    }
}
