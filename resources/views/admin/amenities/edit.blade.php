@extends('admin.layouts.master')

@section('content')
    <div class="main_content_iner ">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="white_card card_height_100 mb_30">
                        <div class="white_card_body">
                            <div class="QA_section">
                                <div class="white_box_tittle list_header">
                                    <h4>Amenity Update</h4>
                                </div>
                                <div class="QA_table mb_30">
                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.amenities.update', $data->id) }}" enctype="multipart/form-data"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mb-3">
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputName">Name</label>
                                                                <input type="text" class="form-control" id="inputName"
                                                                    name="name" value="{{ $data->name  }}"
                                                                    placeholder="P302, F101...">
                                                                @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class="col-md-4 mt-2">
                                                                <label class="form-label" for="icon">Icon
                                                                </label>
                                                                <input type="file" class="form-control" id="icon"
                                                                    name="icon" >
                                                                @error('icon')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                                @php
                                                                    $icons = $data->icon;

                                                                    if (!\Str::contains($icons, 'http')) {
                                                                        $icons = Storage::url($icons);
                                                                    }
                                                                @endphp
                                                                <img src="{{ $icons }}" width="100"
                                                                    class="img-fluid rounded-3 mt-1" class="mt-3">

                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <label class="form-label" for="image">Image </label>
                                                                <input type="file" class="form-control" id="image"
                                                                    name="image">
                                                                @error('image')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror

                                                                @php
                                                                    $url = $data->image;
                                                                    if (!\Str::contains($url, 'http')) {
                                                                        $url = Storage::url($url);
                                                                    }
                                                                @endphp
                                                                <img src="{{ $url }}" width="100"
                                                                    class="img-fluid rounded-3 mt-1" class="mt-3">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-3 mt-2">
                                                                <label class="form-label"
                                                                    for="inputDescription">Description</label>
                                                                <textarea name="description" id="inputDescription" cols="130" rows="5">{{ $data->description }}{{ old('description') }}</textarea>
                                                                @error('description')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                         
                                                        <p></p>

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
@section('script-libs')
@endsection
