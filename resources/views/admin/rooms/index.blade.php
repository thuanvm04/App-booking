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
                                    <h4>Room list</h4>
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
                                            <a href="{{ route('admin.rooms.create') }}" data-bs-toggle="modal"
                                                data-bs-target="#addcategory" class="btn_2">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>

                                                <th scope="col">STT</th>
                                                <th scope="col">ID Room</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Image Thumbnail</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Room Type</th>
                                                <th scope="col">Availability</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($rooms as $key => $value)
                                            <tbody>
                                                <tr>
                                                    <td scope="row">
                                                        {{ $key +1}}
                                                    </td>
                                                    <td>
                                                        room_{{ $value->id }}
                                                    </td>
                                                    
                                                    <td>{{ $value->name }}</td>

                                                    <td>
                                                        <img src=" {{ asset('storage/' . $value->image_thumbnail) }}" width="100"class="img-fluid rounded-3"
                                                            alt="">
                                                    </td>
                                                    <td>
                                                        {{ number_format($value->price) }}$/đêm
                                                    </td>
                                                    <td>
                                                        {{  $value->roomType->name }}
                                                    </td>

                                                    <td>{!! $value->availability_status
                                                        ? '<span class="badge bg-primary"> On</span>'
                                                        : '<span class="badge bg-danger"> Off</span>' !!}
                                                    </td>
                                                    

                                                    <td>{!! $value->is_active
                                                        ? '<span class="badge bg-success"> Yes</span>'
                                                        : '<span class="badge bg-danger"> No</span>' !!}
                                                    </td>

                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a href="{{ route('admin.rooms.edit', $value->id) }}" class="icon-wrapper"  >
                                                                <i class="fas fa-edit"></i>
                                                                <span class="tooltip">Edit</span>
                                                            </a>
                                                            <a class="nav-link icon-wrapper" href="{{ route('admin.rooms.show', $value->id) }}"  >
                                                                <i class="ti-eye eye-icon" ></i>
                                                                <span class="tooltip">View</span>
                                                            </a>
                                                            <form action="{{ route('admin.rooms.destroy', $value->id) }}"
                                                                class="d-inline"
                                                                method="POST"
                                                                id="delete-form-{{ $value->id }}">
                                                              @csrf
                                                              @method('DELETE')
                                                              <span class="icon-wrapper">
                                                                <i class="ti-trash delete-icon" data-form-id="{{ $value->id }}" style="cursor: pointer;"  ></i>
                                                                <span class="tooltip">Delete</span>
                                                              </span>
                                                             
                                                          </form>
                                                        </div>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">{{ $rooms->links() }}</div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>

    </div>
@endsection
