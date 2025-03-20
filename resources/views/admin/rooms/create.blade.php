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
                                    <h4>Room add</h4>

                                </div>
                                <div class="QA_table mb_30">
                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.rooms.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="row mb-3">
                                                            <div class="col-md-5 mt-2">
                                                                <div>
                                                                    <label class="form-label" for="image_thumbnail">Image
                                                                        Thumbnail
                                                                    </label>
                                                                    <input type="file" class="form-control fileImage"
                                                                        id="image_thumbnail" name="image_thumbnail"
                                                                        value="{{ old('image_thumbnail') }}">
                                                                    <div class="list-img mt-2">

                                                                    </div>
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
                                                                        @foreach ($roomTypes as $rtype)
                                                                            <option value="{{ $rtype->id }}">
                                                                                {{ $rtype->name }}
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
                                                                        value="{{ old('price') }}" placeholder="Price">
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
                                                                        value="{{ old('name') }}"
                                                                        placeholder="P302, F101...">
                                                                    @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>


                                                                <div class="mt-2">
                                                                    <label class="form-label"
                                                                        for="inputNaDescription">Description</label>
                                                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                                                    @error('description')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12 mt-5">
                                                                <button type="button"
                                                                    class="btn btn-success btn-sm float-end"
                                                                    onclick="addImageGallery()">Thêm
                                                                    ảnh</button>
                                                                <div class="live-preview">
                                                                    <div class="row gy-4" id="gallery_list">
                                                                        <div class="col-md-3" id="gallery_default_item">
                                                                            <label for="gallery_default"
                                                                                class="form-label">Image</label>
                                                                            <div class="d-flex">
                                                                                <input type="file"
                                                                                    class="form-control fileImages"
                                                                                    name="room_images[]"
                                                                                    id="gallery_default">

                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="availability_status" name="availability_status"
                                                                    checked value="1">
                                                                <label class="form-label form-check-label"
                                                                    for="availability_status">
                                                                    Availability Status
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    id="is_active" name="is_active" checked value="1">
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
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
        <div class="col-md-3" id="${id}_item">
            <label for="${id}" class="form-label">Image</label>
            <div class="d-flex">
                <input type="file" class="form-control" name="room_images[]" id="${id}">
                <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                    <span class="bx bx-trash"></span>
                </button>
            </div>
        </div>
    `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>

    <script>
        let listImg = document.querySelector('.list-img');
        let fileImage = document.querySelector('.fileImage');
        fileImage.onchange = function() {
            let file = fileImage.files[0]; // Chỉ lấy file đầu tiên
            if (file) {
                console.log(file);
                let img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.style.borderRadius = '10px';
                img.style.width = '200px';
                img.style.height = '200px';
                img.style.objectFit = 'cover'; // Đảm bảo ảnh không bị méo
                listImg.innerHTML = ''; // Xóa nội dung cũ
                listImg.appendChild(img);
            }
        }
    </script>
@endsection
