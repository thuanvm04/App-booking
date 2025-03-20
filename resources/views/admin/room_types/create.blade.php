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
                                    <h4>Room type add</h4>

                                </div>
                                <div class="QA_table mb_30">
                                    @if (session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif
                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.room_types.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-md-8 mt-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputName4">Name</label>
                                                                    <input type="text" class="form-control"
                                                                        id="inputName4" name="name"
                                                                        value="{{ old('name') }}" placeholder="Name">
                                                                    @error('name')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="description">Description</label>
                                                                    <textarea class="form-control" id="description" cols="30" rows="4" name="description"> {{ old('description') }}</textarea>
                                                                    @error('description')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div> 
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="amenities">Amenity</label>
                                                                        <select name="amenities[]" id="amenities" multiple class="form-select">
                                                                            @foreach($amenities as $amenity)
                                                                                <option value="{{ $amenity->id }}">{{ $amenity->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @error('amenities')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div> 
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="is_active" name="is_active" checked value="1">
                                                                    <label class="form-label form-check-label" for="is_active">
                                                                        Status
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 mt-2">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputimage">Image</label>
                                                                    <input type="file" class="form-control fileImage"
                                                                        id="inputimage" name="image_thumbnail"
                                                                        placeholder="image">
                                                                        <div class="list-img mt-2" >

                                                                        </div>
                                                                    @error('image_thumbnail')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputPrice">Price</label>
                                                                    <input type="number" class="form-control"
                                                                        id="inputPrice" name="price"
                                                                        value="{{ old('price') }}" placeholder="Price">
                                                                    @error('price')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputPeople">People</label>
                                                                    <input type="number" class="form-control"
                                                                        id="inputPeople" name="people_amount"
                                                                        value="{{ old('people_amount') }}" placeholder="People amount">
                                                                    @error('people_amount')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="inputBed">Bed</label>
                                                                    <input type="number" class="form-control"
                                                                        id="inputBed" name="bed_amount"
                                                                        value="{{ old('bed_amount') }}" placeholder="Bed amount">
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
@section('script-libs')
<script>
    let listImg = document.querySelector('.list-img');
    let fileImage = document.querySelector('.fileImage');
    fileImage.onchange = function () {
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
