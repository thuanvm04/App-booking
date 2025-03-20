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
                                    <h4>Room type Update</h4>

                                </div>
                                <div class="QA_table mb_30">
                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.room_types.update', $data->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="row mb-3">
                                                            <div class="col-md-8 mt-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputName4">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputName4" name="name"
                                                                        value="{{ $data->name }}" placeholder="Name">
                                                                    @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="description">Description</label>
                                                                    <textarea class="form-control" id="description" cols="30" rows="3" name="description"> {{ $data->description }}</textarea>
                                                                    @error('description')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="is_active" name="is_active"
                                                                        {{ $data->is_active ? 'checked' : '' }}
                                                                        value="1">
                                                                    <label class="form-label form-check-label"
                                                                        for="is_active">
                                                                        Status
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="amenities">Amenity</label>
                                                                    <select name="amenities[]" id="amenities" multiple class="form-select">
                                                                        @foreach($amenities as $amenity)
                                                                            <option value="{{ $amenity->id }}" 
                                                                                @if($data->amenities->contains($amenity->id)) selected @endif>
                                                                                {{ $amenity->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('amenities')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputimage">Image</label>

                                                                    <input type="file" class="form-control"
                                                                        id="inputimage" name="image_thumbnail"
                                                                        placeholder="image">

                                                                    @error('image_thumbnail')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror

                                                                    @php
                                                                        $url = $data->image_thumbnail;

                                                                        if (!\Str::contains($url, 'http')) {
                                                                            $url = Storage::url($url);
                                                                        }
                                                                    @endphp

                                                                    <img src="{{ $url }}" width="50"
                                                                        height="50 " class="img-fluid rounded-3"
                                                                        class="mt-3">

                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputPrice">Price</label>

                                                                    <input type="number" class="form-control"
                                                                        id="inputPrice" name="price"
                                                                        value="{{ $data->price }}" placeholder="Price">

                                                                    @error('price')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                    
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputPeople">People</label>

                                                                    <input type="number" class="form-control" id="inputPeople" name="people_amount"
                                                                        value="{{ $data->people_amount }}" placeholder="People amount">

                                                                    @error('people_amount')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror

                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputBed">Bed</label>

                                                                    <input type="number" class="form-control" id="inputBed" name="bed_amount"
                                                                        value="{{$data->bed_amount }}" placeholder="Bed amount">

                                                                    @error('bed_amount')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
