<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="{{ asset('font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-5-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <!-- LEAFLET MAP -->
    <link rel="stylesheet" href="{{ asset('css/leaflet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet-gesture-handling.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet.markercluster.css') }}">
    <link rel="stylesheet" href="{{ asset('css/leaflet.markercluster.default.css') }}">
    <!-- ARCHIVES CSS -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lightcase.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" id="color" href="{{ asset('css/colors/darkblue.css') }}">
    <style>
        .red-heart {
            color: red !important;
        }

        .compare-count {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 18px;
            height: 18px;
            padding: 0 5px;
            font-size: 12px;
            font-weight: 600;
            line-height: 1;
            color: #fff;
            background-color: #dc3545;
            border-radius: 10px;
            margin-left: 5px;
            position: relative;
            top: -8px;
        }

        /* Fix for navigation alignment */
        .navigation li a {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            position: relative;
        }

        /* Ensure proper spacing in navigation */
        .navigation > ul > li {
            display: flex;
            align-items: center;
        }

        /* Hide empty comparison count */
        .compare-count:empty {
            display: none;
        }
    </style>
    @yield('includes')
    <script>
        // Global function to update comparison count
        function updateCompareCount(count) {
            const compareLinks = $('a[href="{{ route('property.compare') }}"]');
            compareLinks.each(function() {
                const compareLink = $(this);
                const existingCount = compareLink.find('.compare-count');
                
                if (count > 0) {
                    if (existingCount.length) {
                        existingCount.text(count);
                    } else {
                        compareLink.append(`<span class="compare-count">${count}</span>`);
                    }
                } else {
                    existingCount.remove();
                }
            });
        }
    </script>
</head>

<body class="@yield('body-class', 'inner-pages listing st-1 agents hd-white')">
    <div id="wrapper">
        @include('partials.header')
        <div class="clearfix"></div>

        @yield('content')

        <a data-scroll href="#wrapper" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
        @include('partials.footer')
    </div>

    <!-- ARCHIVES JS -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/mmenu.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/aos2.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/leaflet-gesture-handling.min.js') }}"></script>
    <script src="{{ asset('js/leaflet-providers.js') }}"></script>
    <script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('js/map-single.js') }}"></script>
    <script src="{{ asset('js/color-switcher.js') }}"></script>
    <script src="{{ asset('js/inner.js') }}"></script>

    @stack('scripts')
</body>

</html>
