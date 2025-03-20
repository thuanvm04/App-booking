<nav class="sidebar vertical-scroll   ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href=""><img src="{{ asset('themes/admin/img/logo.png') }}" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
            <a class="has-arrow" href=" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/dashboard.svg') }}" alt>
                </div>
                <span>Dashboard</span>
            </a>
            <ul>

            </ul>
        </li>
        {{-- <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/14.svg') }}" alt>
                </div>
                <span>Hotels</span>
            </a>
            <ul>
                <li><a href="{{ route('admin.hotels.index') }}">List Hotels</a></li>
                <li><a href="{{ route('admin.hotels.create') }}">Add Hotels</a></li>

            </ul>
        </li> --}}
        <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/15.svg') }}" alt>
                </div>
                <span>Rooms</span>
            </a>
            <ul>
                <li> <a class="has-arrow" aria-expanded="false">
                        <div class="icon_menu">
                            <img src="{{ asset('themes/admin/img/menu-icon/15.svg') }}" alt>
                        </div>
                        <span>Room Type</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.room_types.index') }}">Room Type</a></li>
                        <li><a href="{{ route('admin.room_types.create') }}">Add Room Type</a></li>

                    </ul>
                </li>
                <li>
                    <a class="has-arrow" aria-expanded="false">
                        <div class="icon_menu">
                            <img src="{{ asset('themes/admin/img/menu-icon/16.svg') }}" alt>
                        </div>
                        <span>Rooms</span>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin.rooms.index') }}">Room</a></li>
                        <li><a href="{{ route('admin.rooms.create') }}">Add Room</a></li>

                    </ul>
                </li>
            </ul>
        </li>

        <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/13.svg') }}" alt>
                </div>
                <span>Promotions</span>
            </a>
            <ul>
                <li><a href="{{ route('admin.promotions.index') }}">Promotion</a></li>
                <li><a href="{{ route('admin.promotions.create') }}">Add Promotion</a></li>

            </ul>
        </li>
        <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/9.svg') }}" alt>
                </div>
                <span>Bookings</span>
            </a>
            <ul>
                <li><a href="{{ route('admin.bookings.index') }}">Booking</a></li>
                <li><a href="{{ route('admin.bookings.create') }}">Add Booking</a></li>

            </ul>
        </li>
        <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/10.svg') }}" alt>
                </div>
                <span>Amenites</span>
            </a>
            <ul>
                <li><a href="{{ route('admin.amenities.index') }}">Amenites</a></li>
                <li><a href="{{ route('admin.amenities.create') }}">Add Amenity</a></li>

            </ul>
        </li>
        <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/7.svg') }}" alt>
                </div>
                <span>Services</span>
            </a>
            <ul>
                <li><a href="{{ route('admin.services.index') }}">Services</a></li>
                <li><a href="{{ route('admin.services.create') }}">Add Service</a></li>

            </ul>
        </li>
        
        <li class>
            <a class="has-arrow" aria-expanded="false">
                <div class="icon_menu">
                    <img src="{{ asset('themes/admin/img/menu-icon/8.svg') }}" alt>
                </div>
                <span>Banners</span>
            </a>
            <ul>
                <li><a href="{{ route('admin.banners.index') }}">Banners</a></li>
                <li><a href="{{ route('admin.banners.create') }}">Add Banner</a></li>

            </ul>
        </li>

    </ul>
</nav>
