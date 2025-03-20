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
                                    <h4>Promotions add</h4>

                                </div>
                                <div class="QA_table mb_30">

                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.promotions.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputTitle">Title</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputTitle" name="title"
                                                                    value="{{ old('title') }}"
                                                                    placeholder="title">
                                                                    @error('title')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror    
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputdiscount4">Discount
                                                                    Percentage</label>
                                                                <input type="text" class="form-control"
                                                                    id="inputdiscount4" name="discount_percentage"
                                                                    value="{{ old('discount_percentage') }}"
                                                                    placeholder="discount">
                                                                    @error('discount_percentage')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputStart">Sart Date</label>
                                                                <input type="datetime-local" class="form-control" value="{{ old('start_date') }}"
                                                                    name="start_date" id="inputStart" >
                                                                    @error('start_date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputEnd">End Date</label>
                                                                <input type="datetime-local" class="form-control" value="{{ old('end_date') }}"
                                                                    name="end_date" id="inputinputEnd">
                                                                    @error('end_date')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <div class=" col-md-12">
                                                                <label class="form-label"
                                                                    for="description">Description</label>
                                                                    <textarea class="form-control" id="description" cols="30" rows="3" name="description">  </textarea>

                                                                    @error('description')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
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
