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
                                    <h4>Banner list</h4>
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
                                            <a href="{{ route('admin.banners.create') }}" data-bs-toggle="modal"
                                                data-bs-target="#addcategory" class="btn_2">Add New</a>
                                        </div>
                                    </div>
                                </div>

                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                                <div class="QA_table mb_30">

                                    <table class="table lms_table_active ">
                                        <thead>
                                            <tr>

                                                <th scope="col">STT</th>
                                                <th scope="col">ID Banner </th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Url</th>
                                                <th scope="col">Description</th>
                                                {{-- <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th> --}}
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                     
                                        @foreach ($banners as $key => $value)
                                            <tbody>
                                                <tr>
                                                    <td scope="row">
                                                        {{ $key }}
                                                    </td>
                                                    <td>
                                                        banner_{{$value->id }}
                                                    </td>
                                                    
                                                    <td>{{ $value->title }}</td>
                                                 

                                                    <td>
                                                        @php
                                                        $image_urls = $value->image_url;

                                                        if (!\Str::contains($image_urls, 'http')) {
                                                            $image_urls = Storage::url($image_urls);
                                                        }
                                                    @endphp
                                                    <img src="{{ $image_urls }}" width="50"   height="50 " class="img-fluid rounded-3"
                                                        class="mt-3">
                                                    </td>
                                                    <td>
                                                       {{ \Str::limit($value->url , 15) }}
                                                    </td>
                                                    <td>
                                                        {{ \Str::limit($value->description , 15) }}
                                                    </td>
                                                    {{-- <td>
                                                        {{ $value->start_date }}
                                                    </td>
                                                    <td>
                                                        {{ $value->end_date }}
                                                    </td> --}}
                                                    

                                                    <td>
                                                        <div class="d-flex align-items-center list-action">
                                                            <a href="{{ route('admin.banners.edit', $value->id) }}" class="icon-wrapper ">
                                                                <i class="fas fa-edit"></i>
                                                                <span class="tooltip">Edit</span>
                                                            </a>
                                                            <a class="nav-link icon-wrapper" href="{{ route('admin.banners.show', $value->id) }}"  >
                                                                <i class="ti-eye eye-icon" ></i>
                                                                <span class="tooltip">View</span>
                                                            </a>
                                                            <form action="{{ route('admin.banners.destroy', $value->id) }}"
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
