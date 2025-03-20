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
                                    <h4>Booking list</h4>
                                    <div class="box_right d-flex lms_block">
                                        <div class="serach_field_2">
                                            <div class="search_inner">
                                                <form Active="#">
                                                    <div class="search_field">
                                                        <input type="text" placeholder="Search content here...">
                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add_button ms-2 ">
                                            <a href="{{ route('admin.bookings.create') }}" data-bs-toggle="modal"
                                                data-bs-target="#addcategory" class="btn_2">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>

                                                <th scope="col">STT</th>
                                                <th scope="col">ID Booking</th>
                                                <th scope="col">Room</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Booking Date</th>
                                                <th scope="col">Check In Date</th>
                                                <th scope="col">Check Out Date</th>
                                                {{-- <th scope="col">Status</th> --}}
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($data as $key => $value)
                                            <tbody>
                                                <tr>
                                                    <td scope="row">
                                                        {{ $key }}
                                                    </td>
                                                    <td>
                                                        booking_{{$value->id }}
                                                    </td>
                                                    
                                                    <td>{{ $value->room->name }}</td>

                                                    <td>
                                                        {{  $value->customer->first_name }}
                                                        {{  $value->customer->last_name }}
                                                    </td>

                                                    <td>
                                                        {{  $value->booking_date }}
                                                    </td>

                                                    <td>
                                                        {{  $value->check_in_date }}
                                                    </td>
                                                    <td>
                                                        {{  $value->check_out_date }}
                                                    </td>
                                                    

                                                    {{-- <td>{!! $value->is_active
                                                        ? '<span class="badge bg-success"> Yes</span>'
                                                        : '<span class="badge bg-danger"> No</span>' !!}
                                                    </td> --}}

                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a href="{{ route('admin.bookings.edit', $value->id) }}">
                                                                <i class="btn btn-warning">Edit</i>
                                                            </a>
                                                            <form action="{{ route('admin.bookings.destroy', $value->id) }}" class="d-inline mx-2"
                                                                method="POST" id="delete-form">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        @endforeach
                                    </table>
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
