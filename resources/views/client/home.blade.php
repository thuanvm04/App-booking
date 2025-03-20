@extends('client.layouts.master')
@section('content')
<section class="section-hero">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">

            @foreach ($banners as $key => $value)
                @php
                    $url = $value->image_url;

                    if (!\Str::contains($url, 'http')) {
                        $url = Storage::url($url);
                    }
                @endphp
                <div class="carousel-item active">
                    <a href="{{ $value->url }}">
                        <div class="hero-slide" style="background-image: url({{ $url }});">
                            <div id="particles-js-1" class="particles-js"></div>
                        </div>
                    </a>

                </div>
            @endforeach

        </div>

    </div>
</section>

@include('client.home.search')

<!-- Room -->
@include('client.home.room')


<!-- Amenities -->
@include('client.home.amenities')

<!-- Prices -->
@include('client.home.price')

<!-- Testimonials -->
@include('client.home.testimonial')

<!-- Blog -->
@include('client.home.blog')

@endsection