@extends('layouts.app')
@section('title', 'Acasă')



@section('content')
    <section class="header-map google-maps pull-top map-leaflet-wrapper">
        <div id="map-leaflet"></div>

        <div class="container" data-aos="fade-left">
            <div class="filter">
                <div class="filter-toggle d-lg-none d-sm-flex"><i class="fa fa-search"></i>
                    <h6>ÎNCEPE CĂUTAREA</h6>
                </div>
                <form method="get" id="filter-form">
    <div class="filter-item">
        <label>Statut proprietate</label>
        <select name="property-status">
            <option value="">Orice statut</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->name }}">{{ $status->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="filter-item">
        <label>Tip proprietate</label>
        <select name="property-type">
            <option value="">Orice tip</option>
            @foreach ($types as $type)
                <option value="{{ $type->name }}">{{ $type->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="filter-item">
        <label>Locație</label>
        <select name="location">
            <option value="">Orice locație</option>
            @foreach ($locations as $location)
                <option value="{{ $location->name }}">{{ $location->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="filter-item mb-3">
    <label>Preț</label>
    <input type="text" disabled class="slider_amount m-t-lg-30 m-t-xs-0 m-t-sm-10 mb-3" id="price-range-display">
    <input type="hidden" name="priceMin" id="priceMin" />
    <input type="hidden" name="priceMax" id="priceMax" />
    <div class="slider-range mt-2" id="price-slider"></div>
</div>


    <div class="filter-item filter-half mt-3">
        <label>Dormitoare</label>
        <select name="beds" id="property-beds">
            <option value="">Oricare</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="filter-item filter-half filter-half-last mt-3">
        <label>Băi</label>
        <select name="baths" id="property-baths">
            <option value="">Oricare</option>
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </div>

    <div class="clear"></div>

    <div class="filter-item">
        <label>Suprafață</label>
        <input type="number" name="areaMin" class="area-filter filter-1 mb-0" placeholder="Min" />
        <input type="number" name="areaMax" class="area-filter mb-0" placeholder="Max" />
        <div class="clear"></div>
    </div>

    <div class="filter-item">
        <label class="label-submit p-0 m-0">Trimite</label>
        <br />
        <input type="submit" class="button alt mb-0" value="CAUTĂ PROPRIETATE" />
    </div>
</form>


            </div>
        </div>

    </section>

    <!-- START SECTION RECENTLY PROPERTIES -->
    <section class="recently portfolio bg-white-2">
        <div class="container">
            <div class="section-title ml-3">
                <h3>Proprietăți</h3>
                <h2>Adăugate recent</h2>
            </div>
            <div class="portfolio col-xl-12 px-0">
                <div class="slick-lancers">
                    @foreach ($lastProperties as $property)
                        @php
                            $delay = '';
                            switch ($property->nr) {
                                case 1:
                                    $delay = '150';
                                    break;
                                case 2:
                                    $delay = '250';
                                    break;
                                case 3:
                                    $delay = '350';
                                    break;
                                default:
                                    $delay = ''; // Handle other cases as needed
                                    break;
                            }
                        @endphp

                        <div class="agents-grid" data-aos="fade-up" data-aos-delay="{{ $delay }}">
                            <div class="landscapes">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="project-bottom">
                                            <h4><a
                                                    href="{{ route('property.show', ['id' => $property->id]) }}">Vizualizează</a>
                                            </h4>
                                        </div>
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}"
                                                class="homes-img">
                                                @if ($property->featured == 1)
                                                    <div class="homes-tag button alt featured">Promovat</div>
                                                @endif
                                                <div class="homes-tag button alt sale">{{ $property->status->name }}</div>
                                                <img src="img/properties/{{ $property->id }}/{{ $property->image }}"
                                                    alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}"
                                                class="btn"><i class="fa fa-link"></i></a>
                                            <a href="https://www.youtube.com/watch?v=2xHQqYRcrx4"
                                                class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}"
                                                class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="single-property-1.html">{{ $property->title }}</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-map-marker"></i><span>{{ $property->location }}</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->bedrooms }} Dormitoare</span>
                                            </li>
                                            @if ($property->bathrooms > 0)
                                                <li class="the-icons">
                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                    <span>{{ $property->bathrooms }} Băi</span>
                                                </li>
                                            @endif
                                            <li class="the-icons">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->size }} m2</span>
                                            </li>
                                            @if ($property->garages > 0)
                                            <li class="the-icons">
                                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->garages }} Garaje</span>
                                            </li>
                                            @endif
                                        </ul>
                                        <!-- Price -->
                                        <div class="price-properties footer pt-3 pb-0">
                                            <h3 class="title mt-3">
                                                <a href="single-property-1.html">€ {{ $property->price }}</a>
                                            </h3>
                                            <div class="compare">
                                                <a href="#" title="Compare">
                                                    <i class="flaticon-compare"></i>
                                                </a>
                                                <a href="#" title="Share">
                                                    <i class="flaticon-share"></i>
                                                </a>
                                                <a href="javascript:void(0);" title="Favorites" class="favorite-toggle" data-id="{{ $property->id }}">
                                                    @if (auth()->check() && auth()->user()->favorites->contains($property->id))
                                                        <i class="fas fa-heart red-heart"></i>
                                                    @else
                                                        <i class="fas fa-heart"></i>
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION RECENTLY PROPERTIES -->

    <!-- START SECTION SERVICES -->
    <section class="services-home">
        <div class="container">
            <div class="section-title">
                <h3>IMOBILIARE BISTRITA</h3>
                <h2>Servicii</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 m-top-0 m-bottom-40" data-aos="fade-up" data-aos-delay="150">
                    <div class="service bg-light-2 border-1 border-light box-shadow-1 box-shadow-2-hover">
                        <div class="media">
                            <i
                                class="fa fa-home bg-base text-white rounded-100 box-shadow-1 p-top-5 p-bottom-5 p-right-5 p-left-5"></i>
                        </div>
                        <div class="agent-section p-top-35 p-bottom-30 p-right-25 p-left-25">
                            <h4 class="m-bottom-15 text-bold-700">CREDITE IPOTECARE </h4>
                            <p>Accesează gratuit cea mai avantajoasă soluție de finanțare pentru tine.

                            </p>
                            <a class="text-base text-base-dark-hover text-size-13"
                                href="properties-full-list.html">Vezi detalii <i
                                    class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 m-top-40 m-bottom-40" data-aos="fade-up" data-aos-delay="250">
                    <div class="service bg-light-2 border-1 border-light box-shadow-1 box-shadow-2-hover">
                        <div class="media">
                            <i
                                class="fas fa-building bg-base text-white rounded-100 box-shadow-1 p-top-5 p-bottom-5 p-right-5 p-left-5"></i>
                        </div>
                        <div class="agent-section p-top-35 p-bottom-30 p-right-25 p-left-25">
                            <h4 class="m-bottom-15 text-bold-700">PROPRIETĂȚI</h4>
                            <p>Vezi proprietăţi disponibile în județul Bistrița-Năsăud</p>
                            <a class="text-base text-base-dark-hover text-size-13"
                                href="properties-full-list.html">Vezi oferte <i
                                    class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 m-top-40 m-bottom-40 commercial" data-aos="fade-up" data-aos-delay="350">
                    <div class="service bg-light-2 border-1 border-light box-shadow-1 box-shadow-2-hover">
                        <div class="media">
                            <i
                                class="fas fa-warehouse bg-base text-white rounded-100 box-shadow-1 p-top-5 p-bottom-5 p-right-5 p-left-5"></i>
                        </div>
                        <div class="agent-section p-top-35 p-bottom-30 p-right-25 p-left-25">
                            <h4 class="m-bottom-15 text-bold-700">ANSAMBLURI REZIDENȚIALE

                            </h4>
                            <p>Vezi lista cu ansambluri rezidențiale disponibile în Bistrița-Năsăud</p>
                            <a class="text-base text-base-dark-hover text-size-13"
                                href="properties-full-list.html">Vezi listă <i
                                    class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION SERVICES -->

    @if ($starredProperties->isNotEmpty())
    <!-- START SECTION FEATURED PROPERTIES -->
    <section class="featured portfolio bg-white-2">
        <div class="container">
            <div class="row">
                <div class="section-title col-md-5">
                    <h3>Proprietăți</h3>
                    <h2>Recomandate</h2>
                </div>
            </div>
            <div class="row portfolio-items">
                @foreach ($starredProperties as $property)
                    @php
                        $delay = '';
                        switch ($property->nr) {
                            case 1:
                                $delay = '150';
                                break;
                            case 2:
                                $delay = '250';
                                break;
                            case 3:
                                $delay = '350';
                                break;
                            case 4:
                                $delay = '150';
                                break;
                            case 5:
                                $delay = '250';
                                break;
                            case 6:
                                $delay = '350';
                                break;
                            default:
                                $delay = '';
                                break;
                        }
                    @endphp
                    <div class="item col-lg-3 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-up" data-aos-delay="150">
                            <div class="project-inner project-head">
                                <div class="project-bottom">
                                    <h4><a href="{{ route('property.show', ['id' => $property->id]) }}">Vizualizează</a>
                                    </h4>
                                </div>
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="homes-img">
                                        <div class="homes-tag button alt sale">{{ $property->status->name }}</div>
                                        <img src="img/properties/{{ $property->id }}/{{ $property->image }}"
                                            alt="home-1" class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="btn"><i
                                            class="fa fa-link"></i></a>
                                    <a href="https://www.youtube.com/watch?v=2xHQqYRcrx4"
                                        class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}"
                                        class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a href="single-property-1.html">{{ $property->title }}</a></h3>
                                <p class="homes-address mb-3">
                                    <a href="single-property-1.html">
                                        <i class="fa fa-map-marker"></i><span>{{ $property->location }}</span>
                                    </a>
                                </p>
                                <!-- Price -->
                                <div class="price-properties footer pt-3 pb-0">
                                    <h3 class="title mt-3">
                                        <a href="single-property-1.html">€ {{ $property->price }}</a>
                                    </h3>
                                    <div class="compare">
                                        <a href="#" title="Compare">
                                            <i class="flaticon-compare"></i>
                                        </a>
                                        <a href="#" title="Share">
                                            <i class="flaticon-share"></i>
                                        </a>
                                        <a href="javascript:void(0);" title="Favorites" class="favorite-toggle" data-id="{{ $property->id }}">
                                            @if (auth()->check() && auth()->user()->favorites->contains($property->id))
                                                <i class="fas fa-heart red-heart"></i>
                                            @else
                                                <i class="fas fa-heart"></i>
                                            @endif
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="bg-all">
                <a href="{{ route('properties') }}" class="btn btn-outline-light">Toate anunțurile</a>
            </div>
        </div>
    </section>
    <!-- END SECTION FEATURED PROPERTIES -->
    @endif

    <!-- START SECTION COUNTER UP -->
    <section class="counterup">
        <div class="container" data-aos="fade-up">
            @include('partials.counter', [
                'totalPropertiesCount' => $totalPropertiesCount,
                'companies' => $companies,
                'agentsCount' => $agentsCount,
                'languagesCount' => $languagesCount,
            ])
        </div>
    </section>
    <!-- END SECTION COUNTER UP -->

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mmenu.min.js"></script>
    <script src="js/mmenu.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/aos2.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/slick3.js"></script>
    <script src="js/fitvids.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/isotope.pkgd.min.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/lightcase.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/ajaxchimp.min.js"></script>
    <script src="js/newsletter.js"></script>
    <script src="js/jquery.form.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/forms-2.js"></script>
    <script src="js/leaflet.js"></script>
    <script src="js/leaflet-gesture-handling.min.js"></script>
    <script src="js/leaflet-providers.js"></script>
    <script src="js/leaflet.markercluster.js"></script>
    <script src="js/color-switcher.js"></script>
    <script src="js/inner.js"></script>
    <script src="js/light.js"></script>

    <script src="revolution/js/jquery.themepunch.tools.min.js"></script>
    <script src="revolution/js/jquery.themepunch.revolution.min.js"></script>

    <script src="js/script.js"></script>
    <script src="js/add-to-favorite.js"></script>

    <script src="js/leaflet.snogylop.js"></script>
    <script>
        // Initialize the slider for the price range
// Initialize the slider for the price range
var priceSlider = document.getElementById('price-slider');
var priceMinInput = document.getElementById('priceMin');
var priceMaxInput = document.getElementById('priceMax');
var priceRangeDisplay = document.getElementById('price-range-display');

// Initialize the price slider
$(priceSlider).slider({
    range: true,
    min: 0,
    max: 1000000, // Adjust this to match the max price of properties
    step: 1000,
    values: [0, 1000000], // Set the initial range, adjust as needed
    slide: function(event, ui) {
        // Update the hidden inputs with the slider values
        priceMinInput.value = ui.values[0];
        priceMaxInput.value = ui.values[1];

        // Update the display of the range
        priceRangeDisplay.value = '€' + ui.values[0].toLocaleString() + ' - €' + ui.values[1].toLocaleString();
    }
});


    </script>
    <script>
        
        // Initialize Leaflet map
        var map = L.map('map-leaflet', {
            center: [47.16347044782513, 24.78581920516772],
            zoom: 10,
            minZoom: 10, // Minimum zoom level
            maxZoom: 18 // Maximum zoom level
        });

        // Add the tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        // Define the boundary coordinates for Bistrița-Năsăud
        var bounds = L.latLngBounds([
            [45.9, 23.1], // Southwest corner
            [48.3, 26.3] // Northeast corner
        ]);

        // Restrict map panning and zooming to the defined bounds
        map.setMaxBounds(bounds);

        // Ensure the map stays within bounds
        map.on('moveend', function() {
            var currentBounds = map.getBounds();
            if (!bounds.contains(currentBounds)) {
                var center = map.getCenter();
                var newCenter = [
                    Math.max(bounds.getSouth(), Math.min(center.lat, bounds.getNorth())),
                    Math.max(bounds.getWest(), Math.min(center.lng, bounds.getEast()))
                ];
                map.setView(newCenter, map.getZoom(), {
                    animate: false
                });
            }
        });

        function updateMap() {
            map.eachLayer(function(layer) {
                if (layer instanceof L.GeoJSON || layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });
            fetch('/geojson/bistrita_nasaud.geojson')
                .then(response => response.json())
                .then(region => {
                    L.geoJson(region, {
                        invert: true,
                        worldLatLngs: [
                            L.latLng([90, 360]),
                            L.latLng([90, -180]),
                            L.latLng([-90, -180]),
                            L.latLng([-90, 360])
                        ]
                    }).addTo(map);
                    var form = document.getElementById('filter-form');
    var formData = new FormData(form);
    
    formData.delete('_token'); // Remove CSRF token since it's not needed for GET
    if (priceMinInput.value && priceMaxInput.value) {
        formData.set('priceMin', formatPrice(priceMinInput.value / 1000)); // Convert price to thousands and remove extra digits
        formData.set('priceMax', formatPrice(priceMaxInput.value / 1000)); // Convert price to thousands and remove extra digits
    }


                    fetch('/get_properties?' + new URLSearchParams(formData).toString())
                        .then(response => response.json())
                        .then(properties => {
                            properties.forEach(property => {
                                if (property.latitude && property.longitude) {
                                    var icon = L.icon({
                                        iconUrl: property.type.icon ?
                                            `/img/map/${property.type.icon}` :
                                            "/img/map/marker-icon.png",
                                        iconRetinaUrl: property.type.icon ?
                                            `/img/map/${property.type.icon}` :
                                            "/img/map/marker-icon-2x.png",
                                        shadowUrl: "/img/map/marker-shadow.png",
                                        iconSize: [25, 41],
                                        iconAnchor: [12, 41],
                                        popupAnchor: [1, -34],
                                        tooltipAnchor: [16, -28],
                                        shadowSize: [41, 41],
                                    });

                                    // Create marker with the determined icon
                                    let marker = L.marker([property.latitude, property.longitude], {
                                        icon: icon
                                    }).addTo(map);

                                    let popupContent = `
                                    <div class="recently portfolio bg-white-2">
                                        <div class="landscapes">
                                            <div class="project-single">
                                                <div class="project-inner project-head">
                                                    <div class="project-bottom">
                                                        <h4><a href="/properties/${property.id}">Vizualizează</a></h4>
                                                    </div>
                                                    <div class="homes">
                                                        <a href="/properties/${property.id}" class="homes-img">
                                                            <div class="homes-tag button alt featured">${property.status.name}</div>
                                                            <img src="/img/properties/${property.id}/${property.image}" alt="home-1" class="img-responsive">
                                                        </a>
                                                    </div>
                                                    <div class="button-effect">
                                                        <a href="/properties/${property.id}" class="btn"><i class="fa fa-link"></i></a>
                                                    </div>
                                                </div>
                                                <div class="homes-content">
                                                    <div class="price-properties footer pt-3 pb-0">
                                                        <h3 class="title mt-3">
                                                            <a href="/property/${property.id}">€ ${property.price}</a>
                                                        </h3>
                                                        <div class="compare">
                                                            <a href="#" title="Compare">
                                                                <i class="flaticon-compare"></i>
                                                            </a>
                                                            <a href="#" title="Share">
                                                                <i class="flaticon-share"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" title="Favorites" class="favorite-toggle" data-id="${property.id}">
                                                                ${ property.is_favorited ? '<i class="flaticon-heart red-heart"></i>' : '<i class="flaticon-heart"></i>' }
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                marker.bindPopup(popupContent, { closeButton: false });
                                } else {
                                    console.log('Invalid coordinates for property:', property);
                                }
                            });
                        })
                        .catch(error => console.error('Error fetching properties:', error));
                })
                .catch(error => console.error('Error fetching GeoJSON:', error));

        }
        updateMap();

        document.getElementById('filter-form').addEventListener('submit', function(e) {
            e.preventDefault();
            updateMap();
        });
    </script>

@endsection
