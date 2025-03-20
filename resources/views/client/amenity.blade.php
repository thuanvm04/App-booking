@extends('client.layouts.master')
@section('content')
<!-- Banner -->
<section class="section-banner">
    <div class="row banner-image">
        <div class="banner-overlay"></div>
        <div class="banner-section">
            <div class="lh-banner-contain">
                <h2>Our Amenities</h2>
                <div class="lh-breadcrumb">
                    <h5>
                        <span class="lh-inner-breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                        </span>
                        <span> / </span>
                        <span>
                            <a href="javascript:void(0)">Our Amenities</a>
                        </span>
                    </h5>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="section-services padding-tb-100">
    <div class="container">
        <div class="banner" data-aos="fade-up" data-aos-duration="1200">
            <h2>Enjoy Your Best <span>Amenities</span></h2>
        </div>
        <div class="row mtb-m-12">
           @foreach($amenities as $key => $value)
           @php
           $image = $value->image;
           $icons = $value->icon;

           if (!\Str::contains($image, 'http')) {
               $image = Storage::url($image);
           }
           if (!\Str::contains($icons, 'http')) {
               $icons = Storage::url($icons);
           }
       @endphp
           
           <div class="col-lg-4 col-md-6 m-tb-12">
            <div class="lh-services" data-aos="fade-up" data-aos-duration="1200">
                <div class="lh-services-contain">
                    <div class="lh-icon">
                        <img src="{{ $icons }}" class="svg-img" alt="services img">
                    </div>
                    <h4 class="lh-services-heading">{{ $value->name }}</h4>
                    <p>{{ $value->description }}</p>
                </div>
                <div class="lh-services-image">
                    <img src="{{ $image }}" alt="services-1">
                </div>
            </div>
        </div>
           @endforeach
        </div>
    </div>
</section>
@endsection