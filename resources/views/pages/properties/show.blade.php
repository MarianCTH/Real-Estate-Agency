@extends('layouts.app')
@section('title', $property->title)

@section('includes')
    <link rel="stylesheet" href="{{ asset('css/timedropper.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datedropper.css') }}">
@endsection

@section('body-class', 'inner-pages sin-1 homepage-4 hd-white')

@section('content')

    <!-- START SECTION PROPERTIES LISTING -->
    <section class="single-proper blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="headings-2 pt-0">
                                <div class="pro-wrapper">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <h3>{{ $property->title }}<span
                                                    class="mrg-l-5 category-tag">{{ $property->status->name }}</span></h3>
                                            <div class="mt-0">
                                                <a href="#listing-location" class="listing-address">
                                                    <i
                                                        class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>{{ $property->location }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="single detail-wrapper mr-2">
                                        <div class="detail-wrapper-body">
                                            <div class="listing-title-bar">
                                                <h4>{{ $property->price }}€</h4>
                                                <div class="mt-0">
                                                    <a href="#listing-location" class="listing-address">
                                                        <p>{{ number_format($property->price / $property->size, 2) }} €
                                                            / m2</p>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <!-- main slider carousel items -->
                            <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                                <h5 class="mb-4">Galerie</h5>
                                <div class="carousel-inner">
                                    @foreach ($images as $index => $image)
                                        <div class="{{ $index === 0 ? 'active' : '' }} item carousel-item"
                                            data-slide-number="{{ $index }}">
                                            <img src="{{ $image }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                    @endforeach

                                    <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i
                                            class="fa fa-angle-left"></i></a>
                                    <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i
                                            class="fa fa-angle-right"></i></a>

                                </div>
                                <!-- main slider carousel nav controls -->
                                <ul class="carousel-indicators smail-listing list-inline">
                                    @foreach ($images as $index => $image)
                                        <li class="list-inline-item {{ $index === 0 ? 'active' : '' }}">
                                            <a id="carousel-selector-{{ $index }}"
                                                class="{{ $index === 0 ? 'selected' : '' }}"
                                                data-slide-to="{{ $index }}" data-target="#listingDetailsSlider">
                                                <img src="{{ $image }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- main slider carousel items -->
                            </div>
                            <div class="blog-info details mb-30">
                                <h5 class="mb-4">Descriere</h5>
                                <p class="mb-3">{{ $property->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="single homes-content details mb-30">
                        <!-- title -->
                        <h5 class="mb-4">Detalii proprietate</h5>
                        <ul class="homes-list clearfix">
                            <li>
                                <span class="font-weight-bold mr-1">ID Proprietate:</span>
                                <span class="det">{{ $property->id }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Tip:</span>
                                <span class="det">{{ $property->type->name }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Status:</span>
                                <span class="det">{{ $property->status->name }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Preț:</span>
                                <span class="det">{{ $property->price }} €</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Dormitoare:</span>
                                <span class="det">{{ $property->bedrooms }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Băi:</span>
                                <span class="det">{{ $property->bathrooms }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">Garaje:</span>
                                <span class="det">{{ $property->garages }}</span>
                            </li>
                            <li>
                                <span class="font-weight-bold mr-1">An construcție:</span>
                                <span class="det">10/6/2020</span>
                            </li>
                        </ul>
                    </div>
                    <div class="property-location map">
                        <h5>Locație</h5>
                        <div class="divider-fade"></div>
                        <div id="map-contact" class="contact-map"></div>
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="single widget">
                        <!-- Start: Schedule a Tour -->
                        <div class="schedule widget-boxed mt-33 mt-0">
                            <div class="widget-boxed-header">
                                <h4><i class="fa fa-calendar pr-3 padd-r-10"></i>Stabilește o vizită</h4>
                            </div>
                            <form name="contact_form" method="post" action="">

                                <div class="widget-boxed-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 book">
                                            <input type="text" id="reservation-date" data-lang="en"
                                                data-large-mode="true" data-min-year="2017" data-max-year="2020"
                                                data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0"
                                                data-theme="my-style" class="form-control" readonly="">
                                        </div>
                                        <div class="col-lg-6 col-md-12 book2">
                                            <input type="text" id="reservation-time" class="form-control"
                                                readonly="">
                                        </div>
                                    </div>
                                    <div class="row mrg-top-15 mb-3">
                                        <div class="agent-contact-form-sidebar">
                                            <input type="text" id="fname" name="full_name"
                                                placeholder="Nume complet" required />
                                            <input type="number" id="pnumber" name="phone_number"
                                                placeholder="Număr de telefon" required />
                                            <input type="email" id="emailid" name="email_address"
                                                placeholder="Adresă de email" required />
                                            <textarea placeholder="Mesaj" name="message" required></textarea>
                                            <input type="submit" name="sendmessage" class="multiple-send-message"
                                                value="Trimite cererea" />
                                        </div>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <!-- End: Schedule a Tour -->
                        <!-- end author-verified-badge -->
                        <div class="sidebar">
                            <div class="widget-boxed mt-33 mt-5">
                                <div>
                                    <h4>Informații Agent</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="sidebar-widget author-widget2">
                                        <div class="author-box clearfix">
                                            <img src="{{ asset('img/users/' . $property->user->image) }}"
                                                alt="author-image" class="author__img">
                                            <h4 class="author__title">{{ $property->user->name }}</h4>
                                            <p class="author__meta">{{ $property->user->type }}</p>
                                        </div>
                                        <ul class="author__contact">
                                            <li><span class="la la-map-marker"><i
                                                        class="fa fa-map-marker"></i></span>{{ $property->user->userDetail->address ?? 'N/A' }}
                                            </li>
                                            <li><span class="la la-phone"><i class="fa fa-phone"
                                                        aria-hidden="true"></i></span><a
                                                    href="tel:{{ $property->user->userDetail->phone ?? '#' }}">{{ $property->user->userDetail->phone ?? 'N/A' }}</a>
                                            </li>
                                            <li><span class="la la-envelope-o"><i class="fa fa-envelope"
                                                        aria-hidden="true"></i></span>
                                                <a href="mailto:{{ $property->user->email ?? '#' }}">
                                                    {{ $property->user->email ?? 'N/A' }}
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                            <div class="main-search-field-2">
                                <div class="widget-boxed">
                                    <div class="widget-boxed">
                                        <div class="widget-boxed-header">
                                            <h4>Alte anunțuri de la {{ $property->user->name }}</h4>
                                            <a href="{{ route('user.properties', $property->user->id) }}">Vezi toate
                                                anunțurile</a>

                                        </div>
                                        <div class="widget-boxed-body">
                                            <div class="slick-lancers">
                                                @foreach ($otherProperties as $otherProperty)
                                                    <div class="agents-grid mr-0">
                                                        <div class="listing-item compact">
                                                            <a href="{{ route('property.show', ['id' => $otherProperty->id]) }}"
                                                                class="listing-img-container">
                                                                <div class="listing-badges">
                                                                    <span
                                                                        class="featured">{{ $otherProperty->price }} €</span>
                                                                    <span>{{ $property->status->name }}</span>
                                                                </div>
                                                                <div class="listing-img-content">
                                                                    <span
                                                                        class="listing-compact-title">{{ $otherProperty->title }}
                                                                        <i></i></span>
                                                                    <ul class="listing-hidden-content">
                                                                        <li>Suprafață <span>{{ $otherProperty->size }} m2
                                                                            </span></li>
                                                                        <li>Camere
                                                                            <span>{{ $otherProperty->bedrooms }}</span>
                                                                        </li>
                                                                        @if ($otherProperty->bathrooms > 0)
                                                                            <li>Băi
                                                                                <span>{{ $otherProperty->bathrooms }}</span>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                                <img src="{{ asset('img/properties/' . $otherProperty->id . '/' . $otherProperty->image) }}"
                                                                    alt="{{ $otherProperty->title }}">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <!-- START SIMILAR PROPERTIES -->
            @if ($properties->isNotEmpty())

                <section class="similar-property featured portfolio p-0 bg-white-inner">
                    <div class="container">
                        <h5>Proprietăți promovate</h5>
                        <div class="row portfolio-items">
                            @foreach ($properties as $property)
                                @include('components.property-card', ['property' => $property])
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <!-- END SIMILAR PROPERTIES -->
        </div>
    </section>

    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/range-slider.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/slick4.js') }}"></script>
    <script src="{{ asset('js/fitvids.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/popup.js') }}"></script>
    <script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}"></script>
    <script src="{{ asset('js/timedropper.js') }}"></script>
    <script src="{{ asset('js/datedropper.js') }}"></script>
    <script src="{{ asset('js/jqueryadd-count.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/leaflet-gesture-handling.min.js') }}"></script>
    <script src="{{ asset('js/leaflet-providers.js') }}"></script>
    <script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('js/color-switcher.js') }}"></script>
    <script src="{{ asset('js/inner.js') }}"></script>

    <script>
        $('#reservation-date').dateDropper();
    </script>

    <script>
        this.$('#reservation-time').timeDropper({
            setCurrentTime: false,
            meridians: true,
            primaryColor: "#e8212a",
            borderColor: "#e8212a",
            minutesInterval: '15'
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
                disableOn: 700,
                type: 'iframe',
                mainClass: 'mfp-fade',
                removalDelay: 160,
                preloader: false,
                fixedContentPos: false
            });
        });
    </script>

    <script>
        $('.slick-carousel').each(function() {
            var slider = $(this);
            $(this).slick({
                infinite: true,
                dots: false,
                arrows: false,
                centerMode: true,
                centerPadding: '0'
            });

            $(this).closest('.slick-slider-area').find('.slick-prev').on("click", function() {
                slider.slick('slickPrev');
            });
            $(this).closest('.slick-slider-area').find('.slick-next').on("click", function() {
                slider.slick('slickNext');
            });
        });
    </script>

    <script>
        if ($('#map-contact').length) {
            // Get property coordinates from the server-side variables
            var lat = {{ $property->latitude }};
            var lng = {{ $property->longitude }};

            // Initialize the map with dynamic center based on property coordinates
            var map = L.map('map-contact', {
                zoom: 15,
                maxZoom: 60,
                tap: false,
                gestureHandling: true,
                center: [lat, lng] // Set center using dynamic latitude and longitude
            });

            map.scrollWheelZoom.disable();

            var Hydda_Full = L.tileLayer('https://{s}.tile.openstreetmap.de/tiles/osmde/{z}/{x}/{y}.png', {
                scrollWheelZoom: false,
                attribution: ''
            }).addTo(map);

            var icon = L.divIcon({
                html: '<i class="fa fa-building"></i>',
                iconSize: [50, 50],
                iconAnchor: [50, 50],
                popupAnchor: [-20, -42]
            });

            // Add a marker at the dynamic coordinates
            var marker = L.marker([lat, lng], {
                icon: icon
            }).addTo(map);
        }
    </script>

@endsection
