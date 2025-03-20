    <!-- Header -->
    <header>
        <div class="lh-top-header bg-light py-2">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-start lh-top-social">
                        <div class="lh-mail d-flex align-items-center mr-3">
                            <i class="mx-2 ri-mail-line mr-2"> </i>
                            hoangduylap124@gmail.com
                        </div>
                        <div class="lh-phone d-flex align-items-center">
                            <i class="mx-2 ri-phone-line mr-2">

                            </i>
                            0342014882
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 d-flex align-items-center justify-content-end lh-top-social">
                        <!-- Right Side Of Navbar -->

                    </div>
                </div>
            </div>
        </div>

        <div class="lh-header">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{route('home') }}">
                            <img src="{{ asset('themes/client/assets/img/logo/logo.png') }}" alt="logo"
                                class="lh-logo">
                        </a>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ri-menu-2-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link " href="{{ route('home') }}" role="button">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                        data-bs-toggle="dropdown">
                                        Room Type
                                        <i class="ri-arrow-down-s-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ asset('themes/client/gallery.html') }}">gallery 1</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ asset('themes/client/gallery-2.html') }}">gallery 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                        data-bs-toggle="dropdown">
                                        Room
                                        <i class="ri-arrow-down-s-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ asset('themes/client/room.html') }}">Rooms</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ asset('themes/client/room-2.html') }}">Rooms 2</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ asset('themes/client/room-details.html') }}">Rooms details</a>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                        data-bs-toggle="dropdown">
                                      Amenity
                                        <i class="ri-arrow-down-s-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                       @foreach($amenities as $key => $value)
                                       <li>
                                        <a class="dropdown-item"
                                            href="{{ route('amenity')}}">{{ $value->name }}</a>
                                    </li>
                                       @endforeach
                                      
                                    </ul>
                                </li> 
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button"
                                        data-bs-toggle="dropdown">
                                       Sevice
                                        <i class="ri-arrow-down-s-line"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                       @foreach($services as $key => $value)
                                       <li>
                                        <a class="dropdown-item"
                                            href="{{ route('service')}}">{{ $value->name }}</a>
                                    </li>
                                       @endforeach
                                        
                                    </ul>
                                </li> --}}
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link" href="{{ asset('themes/client/restaurant.html') }}">
                                        Restaurant
                                    </a>
                                </li> --}}
                                
                                @guest
                                    @if (Route::has('login'))
                                        <li class="nav-item ">
                                            <a class="nav-link  mx-2"
                                                href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link  mx-2"
                                                href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link  dropdown-toggle text-primary mx-2"
                                            href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" 
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
