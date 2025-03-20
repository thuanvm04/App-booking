@extends('client.layouts.master')
@section('content')
    <section class="section-room-detsils padding-tb-100">
        <div class="container">
            <div class="row">

                <div class="col-lg-8" data-aos="fade-up" data-aos-duration="2000">
                    <div class="lh-room-details">
                        <div class="lh-main-room">
                            <div class="slider slider-for">

                                @foreach ($room->images as $image)
                                    <div class="lh-room-details-image">
                                        <img src="{{ Storage::url($image->image) }}" alt="room-image">
                                    </div>
                                @endforeach
                            </div>
                            <div class="slider slider-nav">
                                @foreach ($room->images as $image)
                                    <div class="lh-room-details-image">
                                        <img src="{{ Storage::url($image->image) }}" alt="room-image">
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="lh-room-details-contain">
                            <div class="d-flex justify-content-between">
                                <h4 class="lh-room-details-contain-heading">{{ $room->name }}</h4>
                                <h3 class="text-danger font-weight-bold ">{{ $room->price }}$/ Night</h3>
                            </div>
                            <p>{{ $room->description }}</p>
                            <div class="lh-room-details-amenities">
                                <div class="row">
                                    <h4 class="lh-room-inner-heading">Amenities</h4>
                                    @foreach ($room->roomType->amenities as $key => $value)
                                        <div class="col-lg-4 lh-cols-room">
                                            <ul>
                                                <li><code>*</code>{{ $value->name }}</li>

                                            </ul>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <div class="lh-room-details-rules">
                                <div class="lh-room-rules">
                                    <h4 class="lh-room-inner-heading">Rules & Regulation</h4>
                                    <div class="lh-cols-room">
                                        <ul>
                                            <li><code>*</code>No smoking in side the room</li>
                                            <li><code>*</code>Check-in: After 02:00pm</li>
                                            <li><code>*</code>Late checkout: Additional change 50% of the room rate.
                                            </li>
                                            <li><code>*</code>Checkout: Before 11:00am</li>
                                            <li><code>*</code>No Pets</li>
                                            <li><code>*</code>Indentification document is must for hotel registration.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="lh-room-details-review">
                                <div class="lh-room-review">
                                    <h4 class="lh-room-inner-heading">Add A Review</h4>
                                    <p>This is the dolor, sit amet consectetur adipisicing elit. Accusamus sapiente
                                        consectetur debitis blanditiis saepe commodi iste deleniti nisi nam tenetur?</p>
                                </div>
                                <form action="#">
                                    <div class="lh-room-review-form">
                                        <label>Your Name</label>
                                        <input type="text" name="firstname" class="review-form-control" required="">
                                    </div>
                                    <div class="lh-room-review-form">
                                        <label>Your Email</label>
                                        <input type="email" name="email" class="review-form-control" required="">
                                    </div>
                                    <div class="lh-room-review-form">
                                        <label>Comment</label>
                                        <textarea class="review-form-control"></textarea>
                                    </div>
                                    <div class="lh-room-review-form">
                                        <label>Rating</label>
                                        <div class="lh-review-form-rating">
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                            <i class="ri-star-fill"></i>
                                        </div>
                                    </div>
                                    <div class="lh-room-review-buttons">
                                        <button class="lh-buttons result-placeholder" type="submit">
                                            Submit Review
                                        </button>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4" data-aos="fade-up" data-aos-duration="3000">
                    <div class="lh-side-room">
                        <h4 class="lh-room-inner-heading">Reservation</h4>
                        <div class="lh-side-reservation">
                            <form action="{{ route('booking') }}" method="POST">
                                @csrf
                                <input type="hidden" name="room_id" value="{{ $room->id }}">
                                <div class="lh-side-reservation-from">
                                    <label>Check In</label>
                                    <div class=" common_date_picker" id="">
                                        <input class="reservation-form-control" id="datetime" type="datetime-local" name="check_in_date" placeholder="Sep 09,2024" value="{{ old('check_in_date')}}">
                                        {{-- <i class="ri-calendar-line"></i> --}}
                                        @error('check_in_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <label>Check Out</label>
                                    <div class=" common_date_picker" id="">
                                        <input class=" reservation-form-control" id="datetime" type="datetime-local" value="{{ old('check_out_date') }}"
                                            name="check_out_date" placeholder="Sep 09,2024">
                                        {{-- <i class="ri-calendar-line"></i> --}}
                                        @error('check_out_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    </div>
                                </div>

                                <div class="lh-side-reservation-from">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label>People</label>
                                            <div class="custom-select reservation-form-control">
                                                {{ $room->roomType->people_amount }}
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label>Bed Amount</label>
                                            <div class="custom-select reservation-form-control">
                                                {{ $room->roomType->bed_amount }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="lh-side-reservation-from ex-service">
                                    <h4>Extra Services</h4>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="flexcheckboxDefault"
                                            id="flexcheckboxDefault1">
                                        <label class="form-check-label" for="flexcheckboxDefault1">
                                            Air Conditioner
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="flexcheckboxDefault"
                                            id="flexcheckboxDefault2" checked>
                                        <label class="form-check-label" for="flexcheckboxDefault2">
                                            Free Internet
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="flexcheckboxDefault"
                                            id="flexcheckboxDefault3" checked>
                                        <label class="form-check-label" for="flexcheckboxDefault3">
                                            LCD Television
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="flexcheckboxDefault"
                                            id="flexcheckboxDefault4" checked>
                                        <label class="form-check-label" for="flexcheckboxDefault4">
                                            Microwave
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="lh-side-reservation-from">
                                    <h4>Your Price</h4>
                                    <span>${{ $room->price }} / per room</span>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <div class="lh-side-reservation-from-buttons d-flex">

                                        <button class="lh-buttons result-placeholder" type="submit"> Check Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
