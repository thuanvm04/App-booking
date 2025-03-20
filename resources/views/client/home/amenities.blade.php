<section class="section-amenities padding-tb-100">
    <div class="container">
        <div class="banner" data-aos="fade-up" data-aos-duration="2000">
            <h2>Amenities At <span>Hotel</span></h2>
        </div>
        <div class="row mtb-m-12">

            @foreach ($amenity as $index => $item)
                <div class="col-md-6 col-sm-12 m-tb-12">
                    <div class="lh-amenities" data-aos="fade-up" data-aos-duration="1500">
                        <div class="amenities-detail">

                            @if (floor($index / 2) %2 ==0)
                                <div class="amenities-box">

                                    @php
                                        $url = $item->image;

                                        if (!\Str::contains($url, 'http')) {
                                            $url = Storage::url($url);
                                        }
                                        $icons = $item->icon;
                                        if (!\Str::contains($icons, 'http')) {
                                            $icons = Storage::url($icons);
                                        }
                                    @endphp


                                    <img src="{{ $url }}" alt="amenities_1" class="amenities-left-image">
                                </div>
                                <div class="amenities-box">
                                    <div class="lh-amenities-in">
                                        <h4 class="side-number">0{{ $index + 1 }}</h4>
                                        <div class="lh-top-dish">
                                            <img src="{{ $icons }}"
                                                class="svg-img" alt="amenities-dish-1">
                                        </div>
                                        <div class="amenities-contain">
                                            <h4 class="amenities-heading">{{ $item->name }}</h4>
                                            <p>{{ $item->description }}</p>
                                            <a href="{{ route('amenity')}}">Read more <i class="ri-arrow-right-line"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @else
                            @php
                            
                            $icons = $item->icon;
                            if (!\Str::contains($icons, 'http')) {
                                $icons = Storage::url($icons);
                            }
                        @endphp
                            <div class="amenities-box">
                                <div class="lh-amenities-in">
                                    <h4 class="side-number">0{{ $index + 1 }}</h4>
                                    <div class="lh-top-dish">
                                        <img src="{{ $icons }}"
                                            class="svg-img" alt="amenities-dish-1">
                                    </div>
                                    <div class="amenities-contain">
                                        <h4 class="amenities-heading">{{ $item->name }}</h4>
                                        <p>{{ $item->description }}</p>
                                        <a href="{{ route('amenity')}}">Read more <i class="ri-arrow-right-line"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="amenities-box">

                                @php
                                    $url = $item->image;

                                    if (!\Str::contains($url, 'http')) {
                                        $url = Storage::url($url);
                                    }
                                @endphp


                                <img src="{{ $url }}" alt="amenities_1" class="amenities-left-image">
                            </div>
                            @endif

                          
                        </div>

                    </div>
                    
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 text-center pt-5 ">
        <a href="{{ route('amenity')}}" class="nav-link font-weight-bold font-18 ">View more <i class="ri-arrow-right-line"></i></a>
      </div>
</section>
