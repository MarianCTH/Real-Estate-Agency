@extends('layouts.app')
@section('title', 'Proprietăți')

@section('content')
    <div class="clearfix"></div>
    <!-- START SECTION PROPERTIES LISTING -->
    <section class="properties-right list featured portfolio blog pt-5">
        <div class="container">
            <section class="headings-2 pt-0 pb-55">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="pb-2"><a href="{{ route('welcome') }}">Acasă </a> &nbsp;/&nbsp;
                                    <span>Proprietăți</span>
                                </p>
                            </div>
                            <h3>Proprietăți</h3>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <section class="headings-2 pt-0">
                        <div class="pro-wrapper">
                            <div class="detail-wrapper-body">
                                <div class="listing-title-bar">
                                    <div class="text-heading text-left">
                                        <p class="font-weight-bold mb-0 mt-3">{{ $properties->count() }} Rezultate găsite
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid">
                                <div class="input-group border rounded input-group-lg w-auto mr-4">
                                    <label
                                        class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3"
                                        for="inputGroupSelect01"><i
                                            class="fas fa-align-left fs-16 pr-2"></i>Sortează:</label>
                                    <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"
                                        data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="sortby"
                                        name="sortby" onchange="sortProperties()">
                                        <option value="1" selected>Cele mai vizionate</option>
                                        <option value="2">Preț(mic la mare)</option>
                                        <option value="3">Preț(mare la mic)</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="row featured portfolio-items">
                        @foreach ($properties as $property)
                            <div class="item col-lg-5 col-md-12 col-xs-12 landscapes sale pr-0">
                                <div class="project-single mb-0 bb-0" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="project-bottom">
                                            <h4><a href="{{ route('property.show', ['id' => $property->id]) }}">Vizualizează
                                                    Proprietate</a></h4>
                                        </div>
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}"
                                                class="homes-img">
                                                @if ($property->featured == 1)
                                                    <div class="homes-tag button alt featured">Promovat</div>
                                                @endif
                                                <div class="homes-tag button alt sale">
                                                    {{ $property->status->name ?? 'N/A' }}  <!-- Display status dynamically -->
                                                </div>                                                <img src="{{ asset('img/properties/' . $property->id . '/' . $property->image) }}"
                                                    alt="{{ $property->title }}" class="img-responsive">
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
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-12 homes-content pb-0 mb-44" data-aos="fade-up">
                                <!-- homes address -->
                                <h3><a
                                        href="{{ route('property.show', ['id' => $property->id]) }}">{{ $property->title }}</a>
                                </h3>
                                <p class="homes-address mb-3">
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}">
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
                                <div class="price-properties">
                                    <h3 class="title mt-3">
                                        <a href="{{ route('property.show', ['id' => $property->id]) }}">€
                                            {{ $property->price }}</a>
                                    </h3>
                                    <div class="compare">
                                        <a href="#" title="Compare">
                                            <i class="fas fa-exchange-alt"></i>
                                        </a>
                                        <a href="#" title="Share">
                                            <i class="fas fa-share-alt"></i>
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
                        @endforeach
                    </div>
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="widget">
                        <!-- Search Fields -->
                        <div class="widget-boxed main-search-field">
                            <div class="widget-boxed-header">
                                <h4>Opțiuni de căutare</h4>
                            </div>
                            <!-- Search Form -->
                            <div class="trip-search">
                                <form class="form" method="GET" action="{{ route('properties') }}">
                                    <!-- Search Input -->
                                    <div class="form-group looking">
                                        <div class="first-select wide">
                                            <div class="main-search-input-item">
                                                <input type="text" name="search" placeholder="Caută..."
                                                    value="{{ request('search') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Location Filter -->
                                    <div class="form-group location">
                                        <select name="location" class="form-control wide">
                                            <option value="">Locație</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                    {{ request('location') == $location->id ? 'selected' : '' }}>
                                                    {{ $location->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Property Type Filter -->
                                    <div class="form-group categories">
                                        <select name="property_type" class="form-control wide">
                                            <option value="">Tip Proprietate</option>
                                            @foreach ($propertyTypes as $propertyType)
                                                <option value="{{ $propertyType->id }}"
                                                    {{ request('property_type') == $propertyType->id ? 'selected' : '' }}>
                                                    {{ $propertyType->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Property Status Filter -->
                                    <div class="form-group categories">
                                        <select name="status" class="form-control wide">
                                            <option value="">Status Proprietate</option>
                                            @foreach($propertyStatuses as $status)
                                                <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach


                                        </select>
                                    </div>
                                    <!-- Bedrooms Filter -->
                                    <div class="form-group beds">
                                        <select name="bedrooms" class="form-control wide">
                                            <option value="">Dormitoare</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('bedrooms') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <!-- Bathrooms Filter -->
                                    <div class="form-group bath">
                                        <select name="bathrooms" class="form-control wide">
                                            <option value="">Băi</option>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{ $i }}"
                                                    {{ request('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <!-- Price and Area Range -->
                                    <div class="main-search-field-2">
                                        <!-- Area Range -->
                                        <div class="range-slider">
                                            <label>Dimensiunea zonei</label>
                                            <div id="area-range" data-min="0" data-max="1300" data-unit="m2"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <br>
                                        <!-- Price Range -->
                                        <div class="range-slider">
                                            <label>Gama de prețuri</label>
                                            <div id="price-range" data-min="0" data-max="600000" data-unit="€"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>

                                    <!-- Search Button -->
                                    <div class="col-lg-12 no-pds">
                                        <div class="at-col-default-mar">
                                            <button class="btn btn-default hvr-bounce-to-right"
                                                type="submit">Caută</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </aside>
            </div>
            <nav aria-label="Pagination" class="agents pt-55">
                {{ $properties->appends(request()->query())->links() }}
            </nav>
        </div>
    </section>
    <!-- END SECTION PROPERTIES LISTING -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/rangeSlider.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mmenu.min.js"></script>
    <script src="js/mmenu.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/aos2.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/slick4.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/lightcase.js"></script>
    <script src="js/search.js"></script>
    <script src="js/light.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/popup.js"></script>
    <script src="js/searched.js"></script>
    <script src="js/ajaxchimp.min.js"></script>
    <script src="js/newsletter.js"></script>
    <script src="js/inner.js"></script>
    <script src="js/color-switcher.js"></script>
    <script src="js/add-to-favorite.js"></script>
    <script>
        function sortProperties() {
            // Get the selected sort option
            var sortby = document.getElementById('sortby').value;

            // Collect the current filters
            var params = new URLSearchParams(new FormData(document.querySelector('form'))).toString();

            // Add the sortby parameter to the filters
            params += '&sortby=' + sortby;

            // Make an AJAX request to fetch the sorted properties
            fetch('/properties?' + params)
                .then(response => response.text())
                .then(html => {
                    // Update the properties list
                    document.querySelector('.featured.portfolio-items').innerHTML =
                        new DOMParser().parseFromString(html, 'text/html').querySelector('.featured.portfolio-items').innerHTML;

                    // Update the pagination links
                    document.querySelector('nav[aria-label="Pagination"]').innerHTML =
                        new DOMParser().parseFromString(html, 'text/html').querySelector('nav[aria-label="Pagination"]').innerHTML;
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

@endsection
