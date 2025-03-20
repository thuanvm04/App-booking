<?php

namespace App\Http\Controllers;

use App\Models\MarketingBanner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
  public function index(){
    $banners = MarketingBanner::all();
    return view('client.layouts.master',  compact('banners'));
  }
}
