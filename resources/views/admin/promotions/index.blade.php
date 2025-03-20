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
                                    <h4>Promotion list</h4>
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
                                            <a href="{{ route('admin.promotions.create') }}"
                                           class="btn_2">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>

                                                <th scope="col">STT</th>
                                                <th scope="col">ID promotion</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Discount Percentage</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Sart Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col ">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($promotions as $key => $value)
                                            <tbody>
                                                <tr>
                                                    <th scope="row">
                                                        {{ $key }}</th>
                                                    <td> promoiton_{{$value->id }}</td>
                                                    <td>{{ $value->title }}</td>
                                                    <td>Discount {{ $value->discount_percentage }}%</td>
                                                    <td>{{\Str::limit($value->description, 20) }}</td>
                                                    <td>{{ $value->start_date }}</td>
                                                    <td>{{ $value->end_date }}</td>
                                                    
                                                    <td >
                                                        <div class="d-flex align-items-center list-action">
                                                            <a href="{{ route('admin.promotions.edit', $value->id) }}">
                                                                <i class="btn btn-warning">Edit</i>
                                                            </a>
                                                            <form action="{{ route('admin.promotions.destroy', $value->id) }}" class="d-inline mx-2"
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
