<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashbord-mobile-menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('css/default.css') }}">

    @yield('includes-css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />

</head>

<body class="inner-pages maxw1600 m0a dashboard-bd">
    @auth
    <div id="wrapper" class="int_main_wraapper">

        <div class="dash-content-wrap">
            <header id="header-container" class="db-top-header">
                <!-- Header -->
                <div id="header">
                    <div class="container-fluid">
                        <div class="left-side">
                            <div id="logo">
                                <a href="{{ route('welcome') }}"><img src="{{asset('img/logo.png')}}" alt=""></a>
                            </div>
                            <div class="mmenu-trigger">
                                <button class="hamburger hamburger--collapse" type="button">
                                    <span class="hamburger-box">
							<span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                            <nav id="navigation" class="style-1">
                                <ul id="responsive">
                                    @include('partials.navlist')
                                </ul>
                            </nav>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- Header / End -->
            </header>
        </div>
        <div class="clearfix"></div>


        <section class="user-page section-padding pt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-xs-12 pl-0 pr-0 user-dash">
                        <div class="user-profile-box mb-0">
                            <div class="sidebar-header"><img src="{{asset('img/logo-blue.png')}}" alt="header-logo2.png"> </div>
                            <div class="header clearfix">
                                <img src="{{ asset('img/users/' . auth()->user()->image) }}" alt="avatar" class="img-fluid profile-img">
                            </div>
                            <div class="active-user">
                                <h2>{{ auth()->user()->name }}</h2>
                            </div>
                            <div class="detail clearfix">
                                <ul class="mb-0">
                                    @include('partials.userpanel')
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-12 col-xs-12 royal-add-property-area section_100 pl-0 user-dash2">
                        <div class="col-lg-12 mobile-dashbord dashbord">
                            <div class="dashboard_navigationbar dashxl">
                                <div class="dropdown">
                                    <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars pr10 mr-2"></i> Navigare</button>
                                    <ul id="myDropdown" class="dropdown-content">
                                        @include('partials.userpanel')
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>

        <footer class="first-footer">
            <div class="second-footer">
                <div class="container">
                    <p>2024 © Copyright <a href="#"> {{ config('app.name') }}</a>. Toate drepturile rezervate.</p>
                    <p>Made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://web.czrsolutions.ro/">CZRSolutions</a></p>
                </div>
            </div>
        </footer>

        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>

        <div id="preloader">
            <div id="status">
                <div class="status-mes"></div>
            </div>
        </div>


        @yield('includes-js')
        <script>
            $(".dropzone").dropzone({
                dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> Faceți clic aici sau plasați fișiere pentru a încărca",
            });

        </script>
        <script>
            $(".header-user-name").on("click", function() {
                $(".header-user-menu ul").toggleClass("hu-menu-vis");
                $(this).toggleClass("hu-menu-visdec");
            });

        </script>

    </div>
    @endauth
    @guest
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endguest
</body>
</html>
