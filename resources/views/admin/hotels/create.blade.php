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
                                    <h4>Hotels add</h4>
                                    
                                </div>
                                <div class="QA_table mb_30">

                                    <div class="col-lg-12">
                                        <div class="white_card card_height_100 mb_30">
                                            <div class="white_card_body">
                                                <div class="card-body">
                                                    <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row mb-3">
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputName4">Name</label>
                                                                <input type="text" class="form-control" id="inputName4"  name="name" value="{{ old('name') }}"
                                                                    placeholder="Name">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputSlug4">Sku</label>
                                                                <input type="text" class="form-control" id="inputSlug4" name="sku" value="{{ Strtoupper(Str::random(6)) }}"
                                                                    placeholder="Sku">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputEmail4">Email</label>
                                                                <input type="email" class="form-control" id="inputEmail4" name="email" value="{{ old('email') }}"
                                                                    placeholder="Email">
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <label class="form-label" for="inputPhone">Phone</label>
                                                                <input type="number" class="form-control" id="inputPhone" name="phone" value="{{ old('phone') }}"
                                                                    placeholder="+84...">
                                                            </div>
                                                        </div>
                                                       
                                                       
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="inputAddress">Address</label>
                                                                <input type="text" class="form-control" id="inputAddress" name="address"value="{{ old('address') }}"
                                                                    placeholder="address detail">
                                                            </div>
                                                            <div class=" col-md-4">
                                                                <label class="form-label" for="inputCity">City</label>
                                                                <input type="text" class="form-control" id="inputCity" value="{{ old('city') }}"
                                                                name="city" placeholder="City">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="inputState">State</label>
                                                                <input type="text" class="form-control" id="inputState" value="{{ old('state') }}"
                                                                name="state" placeholder="State">
                                                            </div>
                                                          
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class=" col-md-12">
                                                                <label class="form-label" for="description">Description</label>
                                                                <textarea  class="form-control" id="description" cols="30" rows="3" value="{{ old('description') }}"
                                                                name="description" > </textarea>
                                                               
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label" for="image_thumbnail">Image Thumbnail</label>
                                                                <input type="file" class="form-control" id="image_thumbnail" name="image_thumbnail">
                                                            </div>
                                                           
                                                          
                                                        </div>
                                                        <div class>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked value="1">
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
