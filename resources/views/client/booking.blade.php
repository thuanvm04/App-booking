@extends('client.layouts.master')
@section('content')
    <section class="checkout-page padding-tb-100">
        <div class="container">

            <form action="{{ route('order') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="row">
                    <div class="col-lg-8 check-dash" data-aos="fade-up" data-aos-duration="2000">
                        <div class="lh-checkout">
                            <div class="lh-checkout-content">
                                <div class="lh-checkout-inner">
                                    <div class="lh-checkout-wrap mb-24">
                                        <div class="lh-checkout-block lh-check-new">
                                            <h3 class="lh-checkout-title">New Customer</h3>
                                            <div class="lh-check-block-content">
                                                <div class="lh-check-subtitle">Checkout Options</div>

                                            

                                                <div class="lh-new-desc">By creating an account you will be able to shop
                                                    faster,
                                                    be up to date on an order's status, and keep track of the orders you
                                                    have
                                                    previously made.
                                                </div>
                                                <div class="lh-new-btn"><a href="#" class="lh-buttons">Continue</a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="lh-checkout-block lh-check-login">
                                            <h3 class="lh-checkout-title">Room detail</h3>
                                            <div class="lh-check-login-form">
                                                @if ($data)
                                                <input type="hidden" name="room_id" value="{{ $data['room_id'] }}">
                                                    <h2>Room Information:</h2>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <img src="{{ Storage::url($room->image_thumbnail) }}"width="200px"
                                                                height="200px" class="rounded-4 object-fit-cover"
                                                                alt="">
                                                        </div>
                                                        <div class="col-4 lh-check-login-info mt-3">
                                                            <p class=""><strong>Room Type:</strong>
                                                                {{ $room->roomType->name }}</p>
                                                            <p class=""><strong>Room Name:</strong>
                                                                {{ $room->name }}</p>
                                                            <p class=""><strong>Price:</strong> ${{ $room->price }}
                                                            </p>
                                                            <p class=""><strong>Description:</strong>
                                                                {{ Str::limit($room->description, 50) }}</p>
                                                            <p class=""><strong>Check In:</strong>
                                                                <STRONG>{{ $data['check_in_date'] }} </STRONG>
                                                            </p>
                                                            <p class=""><strong>Check Out:</strong>
                                                                <strong>{{ $data['check_out_date'] }}</strong>
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="lh-checkout-wrap">
                                        <div class="lh-checkout-block lh-check-bill">
                                            <h3 class="lh-checkout-title">Billing Details</h3>
                                            <div class="lh-bl-block-content">
                                                <div class="lh-check-subtitle">Checkout Options</div>
                                                <span class="lh-bill-option">
                                                    <span>
                                                        <input type="radio" id="bill1" name="radio-group">
                                                        <label for="bill1">I want to use an existing address</label>
                                                    </span>
                                                    <span>
                                                        <input type="radio" id="bill2" name="radio-group" checked>
                                                        <label for="bill2">I want to use new address</label>
                                                    </span>
                                                </span>
                                                <div class="lh-check-bill-form">
                                                    <div class="d-flex">
                                                        <span class="lh-bill-wrap lh-bill-half">
                                                            <label>First Name*</label>
                                                            <input type="text" name="first_name"
                                                                placeholder="Enter your first name" />
                                                                @error('first_name')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                        </span>
                                                        <span class="lh-bill-wrap lh-bill-half">
                                                            <label>Last Name*</label>
                                                            <input type="text" name="last_name"
                                                                placeholder="Enter your last name" />
                                                                @error('last_name')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </span>
                                                    </div>
                                                    <div class="d-flex">
                                                        <span class="lh-bill-wrap lh-bill-half">
                                                            <label>Email*</label>
                                                            <input type="email" name="email"
                                                                placeholder="Enter your email address" />
                                                                @error('email')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </span>
                                                        <span class="lh-bill-wrap lh-bill-half">
                                                            <label>Phone*</label>
                                                            <input type="number" name="phone"
                                                                placeholder=" Enter your phone " />
                                                                @error('phone')
                                                                <p class="text-danger">{{ $message }}</p>
                                                            @enderror
                                                        </span>
                                                    </div>
                                                    <span class="lh-bill-wrap ">
                                                        <label>Address</label>
                                                        <input type="text" name="address" placeholder="Address " />
                                                    </span>
                                                    <span class="lh-bill-wrap ">
                                                        <label>Note</label>
                                                        <textarea name="note" id="" cols="100" rows="2" class="form-control rounded-4" placeholder="Note"></textarea>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 check-sidebar" data-aos="fade-up" data-aos-duration="3000">
                        <div class="lh-side-room">
                            <h4 class="lh-room-inner-heading">Reservation</h4>
                            <div class="lh-side-reservation">

                                <div class="lh-side-reservation-from">
                                    <label>Check In</label>
                                    <div class="calendar" id="">
                                        <input class="digits reservation-form-control" id="minMaxExample" type="text"
                                            value="{{ $data['check_in_date'] }}" name="check_in_date"
                                            placeholder="Sep 09,2024">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                </div>

                                <div class="lh-side-reservation-from">
                                    <label>Check Out</label>
                                    <div class="calendar" id="">
                                        <input class="digits reservation-form-control" id="disabled-days" type="text"
                                            value="{{ $data['check_out_date'] }}" name="check_out_date"
                                            placeholder="Sep 09,2024">
                                        <i class="ri-calendar-line"></i>
                                    </div>
                                </div>
                                <div class="lh-side-reservation-from w-75">
                                    <label>Discount Code</label>
                                    <div class="custom-select reservation-form-control d-flex">
                                        <div>
                                            <input type="text" name="title" id="title"
                                                class="reservation-form-control coupon">
                                        </div>
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        <div>
                                            <button class="lh-buttons coupon" id="applyDiscountButton">Apply</button>
                                        </div>
                                    </div>
                                    <strong id="discountMessage"></strong>
                                </div>

                                <div class="lh-side-reservation-from">
                                    <h4>Your Price</h4>
                                    <p><span>Price:</span> <strong id="">${{ $totalPrice }}</strong></p>
                                    <p id="totalPrice">
                                        <span>Total Price:</span>
                                        <strong class="total_price" id="totalPriceValue">${{ $totalPrice }}</strong>
                                        <input type="hidden" name="total_amount" class="total_price"
                                            id="totalAmountInput" value="{{ $totalPrice }}">
                                    </p>
                                </div>
                                <div class="lh-side-reservation-from">
                                    <div class="lh-side-reservation-from-buttons">
                                        <button class="lh-buttons result-placeholder" type="submit">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection

@section('section-js')
<script>
    $(document).ready(function() {
        var discountApplied = false; // Biến theo dõi việc áp dụng discount
    
        $('#applyDiscountButton').click(function(e) {
            e.preventDefault();
    
            if (discountApplied) {
                return ;
            }
    
            var title = $('#title').val().trim();
            var totalPriceText = $('#totalPriceValue').text().trim();
            var totalPrice = parseFloat(totalPriceText.replace(/[^0-9.-]+/g, ""));
    
            if (isNaN(totalPrice)) {
                $('#discountMessage').text('Total price is not valid.');
                return;
            }
    
            $.ajax({
                url: '{{ route("applyDiscount") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    title: title,
                    total_price: totalPrice
                },
                success: function(response) {
                    if (response.success) {
                        $('#totalPriceValue').text('$' + response.new_total_price.toFixed(2));
                        $('#totalAmountInput').val(response.new_total_price.toFixed(2)); // Cập nhật giá trị trong input
                        $('#discountMessage').text('Discount applied: $' + response.discount_amount.toFixed(2));
                        discountApplied = true; // Đánh dấu đã áp dụng discount
                        $('#applyDiscountButton').prop('disabled', true); // Vô hiệu hóa nút "Apply"
                    } else {
                        $('#discountMessage').text(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    $('#discountMessage').text('An error occurred. Please try again.');
                }
            });
        });
    });
    </script>
    
@endsection
