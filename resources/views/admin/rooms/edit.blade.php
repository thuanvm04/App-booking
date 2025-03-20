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
                                    <h4>Room Update</h4>

                                </div>
                                <div class="QA_table mb_30">

                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.rooms.update', $data->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        {{-- <div class="row mb-3">
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputName">Name</label>
                                                                <input type="text" class="form-control" id="inputName"
                                                                    name="name" value="{{ $data->name }}"
                                                                    placeholder="">
                                                                    @error('name')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
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
                                                                <img src="{{ $url }}" width="100"class="img-fluid rounded-3"
                                                                    class="mt-3">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12 mt-5">
                                                                    <div class="">
                                                                        <div class="live-preview">
                                                                            <button type="button" class="btn btn-success btn-sm float-end" onclick="addImageGallery()">Thêm ảnh</button>
                                                                            <div class="row gy-4" id="gallery_list">
                                                                                @foreach ($data->images as $images)
                                                                                <div class="col-md-4" id="{{ $images->id }}">
                                                                                    <label for="{{ $images->id }}" class="form-label">Image</label>
                                                                                    <div class="d-flex">
                                                                                        <input type="file" class="form-control" name="room_images[]" id="{{ $images->id }}">
                                                                                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('{{ $images->id }}')">
                                                                                            <span class="bx bx-trash"></span>
                                                                                        </button>
                                                                                   

                                                                                    </div>
                                                                                    <img class="mt-3" src="{{ Storage::url($images->image) }}" class="img-fluid rounded-3" alt="" width="70">
                                                                                </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                        <!--end row-->
                                                                    </div>
                                                                </div><!--end col-->
                                                            </div>
                                                            
                                                            <div class="col-md-3 mt-2">
                                                                <label class="form-label"
                                                                    for="inputDescription">Description</label>
                                                                <textarea name="description" id="inputDescription" cols="130" rows="5"
                                                                   >{{ $data->description }}</textarea>
                                                                    @error('description')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                
                                                        <div class="col-mb-3">
                                                            <label class="form-label" for="inputRoomType">Room Types</label>
                                                            <select id="inputRoomType" class="form-control"
                                                                name="room_type_id">
                                                                <option selected>Choose...</option>
                                                                @foreach ($room_types as $room_type)
                                                                    <option value="{{ $room_type->id }}"
                                                                        {{ $room_type->id == $data->room_type_id ? 'selected' : '' }}>
                                                                        {{ $room_type->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('room_type_id')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                        </div>

                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="availability_status" name="availability_status"
                                                                    {{ $data->availability_status ? 'checked' : '' }}
                                                                    value="1">
                                                                <label class="form-label form-check-label"
                                                                    for="availability_status">
                                                                    Availability Status
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="is_active" name="is_active"
                                                                    {{ $data->is_active ? 'checked' : '' }} value="1">
                                                                <label class="form-label form-check-label" for="is_active">
                                                                    Status
                                                                </label>
                                                            </div>
                                                        </div> --}}
                                                        <div class="row mb-3">
                                                            <div class="col-md-5 mt-2">
                                                                <div>
                                                                    <label class="form-label" for="image_thumbnail">Image
                                                                        Thumbnail
                                                                    </label>
                                                                    <input type="file" class="form-control fileImage"
                                                                        id="image_thumbnail" name="image_thumbnail"
                                                                        value="{{ old('image_thumbnail') }}">

                                                                    @php
                                                                        $url = $data->image_thumbnail;

                                                                        if (!\Str::contains($url, 'http')) {
                                                                            $url = Storage::url($url);
                                                                        }
                                                                    @endphp
                                                                    <img src="{{ $url }}"
                                                                        width="100"class="img-fluid rounded-3"
                                                                        class="mt-3">
                                                                    @error('image_thumbnail')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div>
                                                                    <label class="form-label" for="inputRoomType">Room
                                                                        Types</label>
                                                                    <select id="inputRoomType" class="form-control"
                                                                        name="room_type_id">
                                                                        <option selected>Choose...</option>
                                                                        @foreach ($room_types as $room_type)
                                                                            <option value="{{ $room_type->id }}"
                                                                                {{ $room_type->id == $data->room_type_id ? 'selected' : '' }}>
                                                                                {{ $room_type->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('room_type_id')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mt-2">
                                                                    <label class="form-label" for="inputPrice">Price</label>
                                                                    <input type="number" class="form-control"
                                                                        id="inputPrice" name="price"
                                                                        value="{{ $data->price }}" placeholder="Price">
                                                                    @error('price')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7 mt-2">
                                                                <div>
                                                                    <label class="form-label" for="inputName">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputName" name="name"
                                                                        value="{{ $data->name }}">
                                                                    @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                                <div class="mt-2">
                                                                    <label class="form-label"
                                                                        for="inputNaDescription">Description</label>
                                                                    <textarea name="description" class="form-control">{{ $data->description }}</textarea>
                                                                    @error('description')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 mt-5">
                                                                <div class="live-preview">
                                                                    <button type="button" class="btn btn-success btn-sm float-end" onclick="addImageGallery()">Thêm ảnh</button>
                                                                    <div class="row gy-4" id="gallery_list">
                                                                        @foreach ($data->images as $image)
                                                                        <div class="col-md-4" id="image_{{ $image->id }}">
                                                                            <label for="image_{{ $image->id }}" class="form-label">Image</label>
                                                                            <div class="d-flex">
                                                                                <input type="file" class="form-control" name="room_images[{{ $image->id }}]" id="image_{{ $image->id }}" onchange="handleImageChange(event, {{ $image->id }})">
                                                                                <button type="button" class="btn btn-danger" onclick="removeImageGallery('image_{{ $image->id }}', {{ $image->id }})">
                                                                                    <span class="bx bx-trash"></span>
                                                                                </button>
                                                                            </div>
                                                                            <input type="hidden" name="current_images[{{ $image->id }}]" value="{{ $image->image }}">
                                                                            <img class="mt-3 img-fluid rounded-3" src="{{ Storage::url($image->image) }}" alt="" width="70">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="availability_status" name="availability_status"
                                                                    {{ $data->availability_status ? 'checked' : '' }} value="1">
                                                                <label class="form-label form-check-label"
                                                                    for="availability_status">
                                                                    Availability Status
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="is_active" name="is_active"  {{ $data->is_active ? 'checked' : '' }} value="1">
                                                                <label class="form-label form-check-label" for="is_active">
                                                                    Status
                                                                </label>
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
@section('script-libs')
<script>
      function addImageGallery() {
        let id = 'gen_' + Math.random().toString(36).substring(2, 15).toLowerCase();
        let html = `
            <div class="col-md-4" id="${id}_item">
                <label for="${id}" class="form-label">Image</label>
                <div class="d-flex">
                    <input type="file" class="form-control" name="new_room_images[]" id="${id}">
                    <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                        <span class="bx bx-trash"></span>
                    </button>
                </div>
            </div>
        `;
        document.getElementById('gallery_list').insertAdjacentHTML('beforeend', html);
    }

    function removeImageGallery(id, imageId = null) {
        if (confirm('Chắc chắn xóa không?')) {
            let element = document.getElementById(id);
            if (element) {
                element.remove();
                if (imageId !== null) {
                    // Đánh dấu ảnh cần xóa bằng cách thêm ID vào trường ẩn
                    let deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'deleted_images[]';
                    deleteInput.value = imageId;
                    document.getElementById('gallery_list').appendChild(deleteInput);
                }
            }
        }
    }

    function handleImageChange(event, id) {
        let input = event.target;
        let imgElement = input.nextElementSibling.nextElementSibling;
        imgElement.src = URL.createObjectURL(input.files[0]);
    }
</script>
@endsection
