<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('themes/demo/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('themes/demo/css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('themes/demo/css/fontawesome-all.min.css') }}">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="{{ asset('themes/demo/font/flaticon.css') }}">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('themes/demo/style.css') }}">
@yield('section-css')
    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    
</head>
<body>
    <section class="fxt-template-animation fxt-template-layout24" data-bg-image="{{ asset('themes/demo/img/figure/bg24-l.jpg') }}">
        <!-- Video Area Start Here -->
        <div class="fxt-video-background">
            <div class="fxt-video">
                <div id="fxtVideo"
                    data-property="{
                        videoURL:'F_7ZoAQ3aJM', 
                        autoPlay:true, 
                        mute:true, 
                        loop:true, 
                        startAt:0, 
                        opacity:1, 
                        quality:'default', 
                        showControls:false, 
                        optimizeDisplay:true,
                        containment:'.fxt-video-background'
                    }">
                </div>
            </div>
        </div>
   
            @yield('content')
    
    </section>
</body>

<script src="{{ asset('themes/demo/js/jquery.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('themes/demo/js/bootstrap.min.js') }}"></script>
<!-- Imagesloaded js -->
<script src="{{ asset('themes/demo/js/imagesloaded.pkgd.min.js') }}"></script>
<!-- YouTube js -->
<script src="{{ asset('themes/demo/js/jquery.mb.YTPlayer.min.js') }}"></script>
<!-- Validator js -->
<script src="{{ asset('themes/demo/js/validator.min.js') }}"></script>
<!-- Custom Js -->
<script src="{{ asset('themes/demo/js/main.js') }}"></script>
@yield('section-js')
</html>
