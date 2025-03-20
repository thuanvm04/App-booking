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
                                                    <form action="{{ route('admin.services.update', $data->id) }}" enctype="multipart/form-data"
                                                        method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mb-3">
                                                            <div class="col-md-8 mt-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputName">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputName" name="name"
                                                                        value="{{ $data->name }}" placeholder="">
                                                                    @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="inputNaDescription">Description</label>
                                                                    <textarea name="description" class="form-control">{{ $data->description }}</textarea>

                                                                    @error('description')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 mt-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="icon">Icon
                                                                    </label>
                                                                    <input type="file" class="form-control"
                                                                        id="icon" name="icon">
                                                                        @php
                                                                        $Icon = $data->icon;

                                                                        if (!\Str::contains($Icon, 'http')) {
                                                                            $Icon = Storage::url($Icon);
                                                                        }
                                                                    @endphp

                                                                    <img src="{{ $Icon }}" width="50"
                                                                        height="50 " class="img-fluid rounded-3"
                                                                        class="mt-3">
                                                                    @error('icon')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label" for="image">Image
                                                                    </label>
                                                                    <input type="file" class="form-control"
                                                                        id="image" name="image">
                                                                        @php
                                                                        $Image = $data->image;

                                                                        if (!\Str::contains($Image, 'http')) {
                                                                            $Image = Storage::url($Image);
                                                                        }
                                                                    @endphp

                                                                    <img src="{{ $Image }}" width="100"
                                                                        height="50 " class="img-fluid rounded-3"
                                                                        class="mt-3">
                                                                    @error('image')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="image">Price
                                                                    </label>
                                                                    <input type="number" class="form-control"
                                                                        id="price" name="price" placeholder="Price"
                                                                        value="{{ $data->price }}">
                                                                    @error('price')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>


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
