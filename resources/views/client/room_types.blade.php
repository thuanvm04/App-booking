@extends('client.layouts.master')
@section('content')
    <section class="section-rooms bg-gray padding-tb-100">
        <div class="container">
            <div class="banner" data-aos="fade-up" data-aos-duration="2000">
                <h2>Choose Your Luxurious <span>Room</span></h2>
            </div>
            <div class="row mtb-m-12">
                @foreach ($room_types->rooms as $key => $value)
                    <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-duration="1500">
                        <div class="rooms-card">
                            <img src="{{ Storage::url($value->image_thumbnail) }}" style="height: 390px; object-fit: cover; " class="rounded-4" alt="room">
                            <div class="details">
                                <h3>{{ $value->name }}</h3>
                                <span>{{ $value->price }} / Night</span>
                                <ul>
                                    @foreach ($room_types->amenities as $amenity)
                                        <li>{{ $amenity->name }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('room_details', $value->id) }}" class="lh-buttons-2">View More <i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
