@extends('admin.layouts.master')

@section('content')
    <div class="main_content_iner">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Room type list</h4>
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
                                            <a href="{{ route('admin.room_types.create') }}" class="btn_2">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">
                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @endif
                                    <table class="table lms_table_active">
                                        <thead>
                                            <tr>
                                                <th scope="col">STT</th>
                                                <th scope="col">ID Hotel</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Amenities</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomTypes as $key => $value)
                                                <tr>
                                                    <th scope="row">{{ $key + 1 }}</th>
                                                    <td>room_type_{{ $value->id }}</td>
                                                    <td>{{ $value->name }}</td>
                                                    <td>{{ number_format($value->price) }}$/đêm</td>
                                                    <td>
                                                        @php
                                                            $url = $value->image_thumbnail;
                                                            if (!\Str::contains($url, 'http')) {
                                                                $url = Storage::url($url);
                                                            }
                                                        @endphp
                                                        <img src="{{ $url }}" width="50" height="50" class="img-fluid rounded-3">
                                                    </td>
                                                    <td>
                                                        @foreach ($value->amenities as $amenity)
                                                            <span class="badge bg-primary">{{ $amenity->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ \Str::limit($value->description, 20) }}</td>
                                                    <td>{!! $value->is_active ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a href="{{ route('admin.room_types.edit', $value->id) }}" class="icon-wrapper">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="tooltip">Edit</span>
                                                            </a>
                                                            <a class="nav-link icon-wrapper" href="{{ route('admin.room_types.show', $value->id) }}">
                                                                <i class="ti-eye eye-icon"></i>
                                                                <span class="tooltip">View</span>
                                                            </a>
                                                            <form action="{{ route('admin.room_types.destroy', $value->id) }}" class="d-inline" method="POST" id="delete-form-{{ $value->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <span class="icon-wrapper">
                                                                    <i class="ti-trash delete-icon" data-form-id="{{ $value->id }}" style="cursor: pointer;"></i>
                                                                    <span class="tooltip">Delete</span>
                                                                </span>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">{{ $roomTypes->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
