@section('section-css')
<style>
    .swiper-container {
      max-width:100%;
    }
 
    .swiper-slide img {
        display: block;
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
    .nav-tabs.rooms .nav-link{
        width: 100%
    }
</style>

@endsection
<section class="section-room padding-tb-100" data-aos="fade-up" data-aos-duration="2000" id="rooms">

    <div class="container">
        <div class="banner">
            <h2>Choose Your Luxurious <span>Room</span></h2>
        </div>
  
        <nav>
            <div class="swiper-container nav nav-tabs rooms lh-room">
                <div class="swiper-wrapper  ">
                    @foreach ($RoomTypes as $key => $value)
                        @php
                            $RoomTypesName = str_replace(' ', '-', $value->name);
                        @endphp
                        <div class="swiper-slide ">
                            <button room_id="{{ $value->id }}" class="nav-link roomTypeID"
                                id="nav-{{ $RoomTypesName }}-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-{{ $RoomTypesName }}" type="button" role="tab"
                                aria-controls="nav-{{ $RoomTypesName }}" aria-selected="true">
                                <img src="{{ Storage::url($value->image_thumbnail) }}" 
                             alt="1">
                                {{ $value->name }}
                            </button>
                        </div>
                    @endforeach
                </div>

            </div>
        </nav>

        <div class="tab-content room_content" id="nav-tabContent">

            <div class="tab-pane fade active show" id="nav" role="tabpanel" aria-labelledby="nav-tab">
                <div class="container">
                    <div class="row p-0 lh-d-block" style="height: 350px">
                        <div class="col-xl-6 col-lg-12">
                            <div class="lh-room-contain">
                                <div class="lh-contain-heading">
                                    <h4>{{ $RoomTypes[0]->name }}</h4>
                                    <div class="lh-room-price">
                                        <h4> {{ $RoomTypes[0]->price }}$/<span>Per night</span></h4>
                                    </div>
                                </div>
                                <div class="lh-room-size d-flex">
                                    <p>{{ $RoomTypes[0]->bed_amount }} king Bed <span>|</span></p>
                                    <p>Up to {{ $RoomTypes[0]->people_amount }} Guest</p>
                                </div>
                                <p></p>
                                <div class="lh-main-features">
                                    <div class="lh-contain-heading">
                                        <h4>Room Features</h4>
                                    </div>
                                    <div class="lh-room-features">
                                        @foreach ($RoomTypes[0]->amenities as $key => $value)
                                            <ul class="mx-1">
                                                <li class="m-r-10"> {{ $value->name }}</li>
                                            </ul>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 p-0">
                            <div class="room-img">
                                <img src="{{ Storage::url($RoomTypes[0]->image_thumbnail) }}"style="height: 360px; object-fit: cover" alt="room-img"
                                    class="room-image">
                                    <a href="{{ route('room_types', $RoomTypes[0]->id) }}" class="link"><i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>
@section('section-js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 3,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });

            const roomType = document.querySelectorAll('.roomTypeID');
            roomType.forEach(element => {
                console.log(element);
                element.addEventListener('click', function() {
                    const roomID = element.getAttribute('room_id');
                    getRoomInfo(roomID);
                });
            });

            async function getRoomInfo(id) {
                const res = await fetch(`http://bookingapp.test/api/room_type/${id}`);
                const {
                    data
                } = await res.json();
                updateRoomDetail(data);
            }

            function updateRoomDetail(room) {
                const roomContent = document.querySelector('.room_content');
                // console.log(roomContent);

                const amenitiesHtml = room.amenities.map(amenity => `
            <div class="lh-cols-room">
                <ul class="mx-1">
                    <li class="m-r-10">${amenity.name}</li>
                </ul>
            </div>
        `).join('');

                roomContent.innerHTML = `
            <div class="tab-pane fade active show" id="nav-${room.name.replace(' ', '-')}" role="tabpanel"
                aria-labelledby="nav-${room.name.replace(' ', '-')}-tab">
                <div class="container">
                    <div class="row p-0 lh-d-block">
                        <div class="col-xl-6 col-lg-12">
                            <div class="lh-room-contain">
                                <div class="lh-contain-heading">
                                    <h4>${room.name}</h4>
                                    <div class="lh-room-price">
                                        <h4>${room.price}$/<span>Per night</span></h4>
                                    </div>
                                </div>
                                <div class="lh-room-size d-flex">
                                    <p>1100 sq.ft <span>|</span></p>
                                    <p>${room.bed_amount} king Bed <span>|</span></p>
                                    <p>Up to ${room.people_amount} Guest</p>
                                </div>
                                <div class="lh-main-features">
                                    <div class="lh-contain-heading">
                                        <h4>Room Features</h4>
                                    </div>
                                    <div class="lh-room-features">
                                        ${amenitiesHtml}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 p-0">
                            <div class="room-img">
                                <img src="{{ asset('/storage') }}/${room.image_thumbnail}" style="height: 360px; object-fit: cover" alt="room-img" class="room-image">
                                <a href="/room_types/${room.id}" class="link"><i class="ri-arrow-right-line"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
            }
        });
    </script>
@endsection
