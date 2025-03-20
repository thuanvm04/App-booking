@extends('admin.layouts.master')

@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">

                                </div>
                            </div>
                        </div>
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Booking add</h4>

                                </div>

                                <div class="QA_table mb_30">
                                    {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif --}}
                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.bookings.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-3">

                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="checkindate">Check In
                                                                    Date</label>
                                                                <input type="datetime-local" class="form-control"
                                                                    id="checkindate" name="check_in_date"
                                                                    value="{{ old('check_in_date') }}"
                                                                    >
                                                            </div>
                                                            @error('check_in_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror


                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="checkoutdate">Check Out
                                                                    Date</label>
                                                                <input type="datetime-local" class="form-control"
                                                                    id="checkoutdate" name="check_out_date"
                                                                    value="{{ old('check_out_date') }}"
                                                                    >

                                                            </div>
                                                            @error('check_out_date')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror

                                                        </div>
                                                        <div class="row mb-3">

                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="totalamount">Total
                                                                    Price</label>
                                                                <input type="number" class="form-control" id="totalamount"
                                                                    name="total_amount"      value="{{ old('total_amount') }}"
                                                                    placeholder="Enter total">
                                                            </div>
                                                            @error('total_amount')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>


                                                        <div class="col-mb-3">
                                                            <label class="form-label" for="inputRoomType">Room </label>
                                                            <select id="inputRoomType" class="form-control" name="room_id">
                                                                <option selected>Choose...</option>
                                                                @foreach ($rooms as $room)
                                                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                            @error('room_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-mb-3 mt-3">
                                                            <label class="form-label" for="inputRoomType">Customer</label>
                                                            <select id="inputRoomType" class="form-control"
                                                                name="customer_id">
                                                                <option selected>Choose...</option>
                                                                @foreach ($customers as $customer)
                                                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                                        {{ $customer->first_name }}
                                                                        {{ $customer->last_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('customer_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>

                                                        {{-- <div>
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="status" name="status" checked value="1">
                                                                <label class="form-label form-check-label" for="status">
                                                                    Status
                                                                </label>
                                                            </div>
                                                        </div> --}}
                                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
