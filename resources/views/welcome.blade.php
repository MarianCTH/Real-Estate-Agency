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
        <div class="property-type-icons d-flex flex-wrap gap-3 mb-3">
            <input type="hidden" name="property-type" id="selected-property-type" value="">
            @foreach ($types as $type)
                <div class="property-type-icon" data-type="{{ $type->name }}">
                    <div class="icon-wrapper">
                        <div class="leaflet-style-icon">
                            @if ($type->icon)
                                <i class="{{ $type->icon }}"></i>
                            @else
                                <i class="fa fa-building"></i>
                            @endif
                        </div>
                    </div>
                    <span class="icon-label">{{ $type->name }}</span>
                </div>
            @endforeach
        </div>
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

    <!-- END SECTION MAP -->

    <!-- START SECTION FILTERED PROPERTIES -->
    <section class="recently portfolio bg-white-2 pt-5" id="filtered-properties-section" style="display: none; position: relative; z-index: 1000;">
        <div class="container">
            <div class="section-title">
                <h3>PROPRIETĂȚI</h3>
                <h2>REZULTATE CĂUTARE</h2>
            </div>
            <div class="row portfolio-items" id="filtered-properties">
                <!-- Filtered properties will be dynamically inserted here -->
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filter-form');
        if (!filterForm) {
            console.error('Filter form not found');
            return;
        }

        filterForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log('Form submitted');
            
            // Update map markers
            updateMap();
            
            const filteredSection = document.getElementById('filtered-properties-section');
            const filteredContainer = document.getElementById('filtered-properties');
            
            if (!filteredSection || !filteredContainer) {
                console.error('Required elements not found:', {
                    filteredSection: !!filteredSection,
                    filteredContainer: !!filteredContainer
                });
                return;
            }

            try {
                // Get form data
                const formData = new FormData(this);
                const params = new URLSearchParams();
                
                for (let [key, value] of formData.entries()) {
                    if (value) {
                        params.append(key, value);
                    }
                }

                // Add price range if exists
                if (priceMinInput?.value && priceMaxInput?.value) {
                    params.append('priceMin', priceMinInput.value);
                    params.append('priceMax', priceMaxInput.value);
                }

                // Fetch filtered properties
                const response = await fetch('/get_properties?' + params.toString());
                const properties = await response.json();
                
                console.log('Properties received:', properties);

                // Clear existing content and reset styles
                filteredContainer.innerHTML = '';
                filteredContainer.style.height = 'auto';
                filteredContainer.style.position = 'static';

                if (properties && properties.length > 0) {
                    // Show the section and ensure it's visible
                    filteredSection.style.removeProperty('display');
                    filteredSection.style.display = 'block';
                    filteredSection.style.visibility = 'visible';
                    filteredSection.style.opacity = '1';
                    
                    properties.slice(0, 9).forEach((property, index) => {
                        const propertyCard = document.createElement('div');
                        propertyCard.className = 'col-lg-4 col-md-6 col-xs-12 mb-5';
                        propertyCard.setAttribute('data-aos', 'fade-up');
                        propertyCard.setAttribute('data-aos-delay', (index * 100).toString());
                        
                        propertyCard.innerHTML = `
                            <div class="landscapes h-100" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                                <div class="project-single h-100 d-flex flex-column">
                                    <div class="project-head position-relative" style="height: 240px;">
                                        <div class="project-bottom">
                                            <h4><a href="/properties/${property.id}">Vizualizează</a></h4>
                                        </div>
                                        <a href="/properties/${property.id}" class="property-link">
                                            <div class="image-container">
                                                <img src="/img/properties/${property.id}/${property.image}" 
                                                     alt="property" 
                                                     class="w-100 h-100"
                                                     style="object-fit: cover;">
                                                <div class="overlay"></div>
                                            </div>
                                        </a>
                                        <a href="/properties/${property.id}" class="status-tag position-absolute" 
                                           style="top: 15px; right: 15px; z-index: 1; background: #e54242; color: white; padding: 5px 15px; border-radius: 3px; text-decoration: none;">
                                            ${property.status ? property.status.name : 'N/A'}
                                        </a>
                                    </div>

                                    <div class="homes-content p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                        <div class="content-heading">
                                            <h3 class="text-truncate mb-3 pt-2" style="font-size: 18px; min-height: 27px;">
                                                <a href="/properties/${property.id}" class="text-dark">
                                                    ${property.title}
                                                </a>
                                            </h3>
                                            <div class="address-container" style="min-height: 42px; margin-bottom: 1.5rem;">
                                                <p class="homes-address mb-0">
                                                    <a href="/properties/${property.id}" class="text-muted d-flex align-items-start">
                                                        <i class="fa fa-map-marker mt-1 me-2"></i>
                                                        <span style="flex: 1;">${property.location}</span>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="price-and-actions pt-3" style="border-top: 1px solid #eee;">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h3 class="mb-0" style="font-size: 20px; font-weight: 600; color: #274abb;">
                                                    € ${Number(property.price).toLocaleString()}
                                                </h3>
                                                <div class="actions">
                                                    <a href="javascript:void(0);" class="mr-2 share-link" title="Share" 
                                                       data-url="/properties/${property.id}">
                                                        <i class="flaticon-share"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" title="Favorites" class="favorite-toggle" data-id="${property.id}">
                                                        <i class="fas fa-heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        filteredContainer.appendChild(propertyCard);
                    });

                    // Force layout recalculation
                    filteredContainer.offsetHeight;

                    // Refresh AOS animations
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }

                    // Scroll to the filtered section
                    setTimeout(() => {
                        filteredSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 100);
                } else {
                    filteredSection.style.display = 'none';
                }
            } catch (error) {
                console.error('Error in filter submission:', error);
                filteredSection.style.display = 'none';
            }
        });
    });
    </script>
    
    <!-- START SECTION RECENTLY PROPERTIES -->
    <section class="recently portfolio bg-white-2 py-5">
        <!-- Toast Notification -->
        <div class="toast-notification" id="toast" style="display: none;">
            Link-ul a fost copiat!
        </div>
        
        <div class="container">
            <div class="section-title ml-3 mb-4">
                <h3>Proprietăți</h3>
                <h2>Adăugate recent</h2>
            </div>
            <div class="row portfolio-items">
                @foreach ($lastProperties as $property)
                    <div class="col-lg-4 col-md-6 col-xs-12 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 + 150 }}">
                        <div class="landscapes h-100" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                            <div class="project-single h-100 d-flex flex-column">
                                <!-- Property Image Container -->
                                <div class="project-head position-relative" style="height: 240px;">
                                <div class="project-bottom">
                                    <h4><a href="{{ route('property.show', ['id' => $property->id]) }}">Vizualizează</a>
                                    </h4>
                                </div>

                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="property-link">
                                        <div class="image-container">
                                            <img src="img/properties/{{ $property->id }}/{{ $property->image }}" 
                                                 alt="home-1" 
                                                 class="w-100 h-100"
                                                 style="object-fit: cover;">
                                            <div class="overlay"></div>
                                        </div>
                                    </a>
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="status-tag position-absolute" 
                                       style="top: 15px; right: 15px; z-index: 1; background: #e54242; color: white; padding: 5px 15px; border-radius: 3px; text-decoration: none;">
                                        Vânzare
                                    </a>
                                    @if ($property->featured == 1)
                                        <a href="{{ route('property.show', ['id' => $property->id]) }}" class="status-tag position-absolute" 
                                           style="top: 15px; left: 15px; z-index: 1; background: #274abb; color: white; padding: 5px 15px; border-radius: 3px; text-decoration: none;">
                                            Promovat
                                        </a>
                                    @endif
                                </div>

                                <!-- Content Container -->
                                <div class="homes-content p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                    <!-- Title and Location -->
                                    <div class="content-heading">
                                        <h3 class="text-truncate mb-3 pt-2" style="font-size: 18px; min-height: 27px;">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}" class="text-dark">
                                                {{ $property->title }}
                                            </a>
                                        </h3>
                                        <div class="address-container" style="min-height: 42px; margin-bottom: 1.5rem;">
                                            <p class="homes-address mb-0">
                                                <a href="{{ route('property.show', ['id' => $property->id]) }}" class="text-muted d-flex align-items-start">
                                                    <i class="fa fa-map-marker mt-1 me-2"></i>
                                                    <span style="flex: 1;">{{ $property->location }}</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Property Details -->
                                    <div class="property-details mb-4">
                                        <div class="d-flex justify-content-between">
                                            @if($property->bedrooms > 0)
                                                <div class="detail-item">
                                                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                    <span>{{ $property->bedrooms }} Dormitoare</span>
                                                </div>
                                            @endif
                                            @if($property->bathrooms > 0)
                                                <div class="detail-item">
                                                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                    <span>{{ $property->bathrooms }} Băi</span>
                                                </div>
                                            @endif
                                            <div class="detail-item">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>{{ $property->size }} m²</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price and Actions -->
                                    <div class="price-and-actions pt-3" style="border-top: 1px solid #eee;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0" style="font-size: 20px; font-weight: 600; color: #274abb;">
                                                € {{ number_format($property->price, 0, ',', '.') }}
                                            </h3>
                                            <div class="actions">
                                                <a href="#" class="mr-2" title="Compare">
                                                    <i class="flaticon-compare"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="mr-2 share-link" title="Share" 
                                                   data-url="{{ route('property.show', ['id' => $property->id]) }}">
                                                    <i class="flaticon-share"></i>
                                                </a>
                                                <a href="javascript:void(0);" title="Favorites" class="favorite-toggle" data-id="{{ $property->id }}">
                                                    @if (auth()->check() && auth()->user()->favorites->contains($property->id))
                                                        <i class="fas fa-heart" style="color: #ff0000;"></i>
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
                    </div>
                @endforeach
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
            <div class="section-title ml-3 mb-4">
                <h3>Proprietăți</h3>
                <h2>Recomandate</h2>
            </div>
            <div class="row portfolio-items">
                @foreach ($starredProperties as $property)
                    <div class="col-lg-4 col-md-6 col-xs-12 mb-5" data-aos="fade-up" data-aos-delay="{{ $loop->index % 3 * 100 + 150 }}">
                        <div class="landscapes h-100" style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                            <div class="project-single h-100 d-flex flex-column" style = "border:none !important;">
                                <!-- Property Image Container -->
                                <div class="project-head position-relative" style="height: 240px;">
                                    <div class="project-bottom">
                                        <h4><a href="{{ route('property.show', ['id' => $property->id]) }}">Vizualizează</a>
                                        </h4>
                                    </div>
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="property-link">
                                        <div class="image-container">
                                            <img src="img/properties/{{ $property->id }}/{{ $property->image }}" 
                                                 alt="home-1" 
                                                 class="w-100 h-100"
                                                 style="object-fit: cover;">
                                            <div class="overlay"></div>
                                        </div>
                                    </a>
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="status-tag position-absolute" 
                                       style="top: 15px; right: 15px; z-index: 1; background: #e54242; color: white; padding: 5px 15px; border-radius: 3px; text-decoration: none;">
                                        {{ $property->status->name }}
                                    </a>
                                </div>

                                <!-- Content Container -->
                                <div class="homes-content p-4 flex-grow-1 d-flex flex-column justify-content-between">
                                    <!-- Title and Location -->
                                    <div class="content-heading">
                                        <h3 class="text-truncate mb-3 pt-2" style="font-size: 18px; min-height: 27px;">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}" class="text-dark">
                                                {{ $property->title }}
                                            </a>
                                        </h3>
                                        <div class="address-container" style="min-height: 42px; margin-bottom: 1.5rem;">
                                            <p class="homes-address mb-0">
                                                <a href="{{ route('property.show', ['id' => $property->id]) }}" class="text-muted d-flex align-items-start">
                                                    <i class="fa fa-map-marker mt-1 me-2"></i>
                                                    <span style="flex: 1;">{{ $property->location }}</span>
                                                </a>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Price and Actions -->
                                    <div class="price-and-actions pt-3" style="border-top: 1px solid #eee;">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h3 class="mb-0" style="font-size: 20px; font-weight: 600; color: #274abb;">
                                                € {{ number_format($property->price, 0, ',', '.') }}
                                            </h3>
                                            <div class="actions">
                                                <a href="javascript:void(0);" class="mr-2 share-link" title="Share" 
                                                   data-url="{{ route('property.show', ['id' => $property->id]) }}">
                                                    <i class="flaticon-share"></i>
                                                </a>
                                                <a href="javascript:void(0);" title="Favorites" class="favorite-toggle" data-id="{{ $property->id }}">
                                                    @if (auth()->check() && auth()->user()->favorites->contains($property->id))
                                                        <i class="fas fa-heart" style="color: #ff0000;"></i>
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
                    </div>
                @endforeach
            </div>
            <div class="bg-all mt-3">
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
                                    var icon = L.divIcon({
                                        html: `<i class="${property.type.icon}" style="margin-left: 0px; !important;"></i>`,
                                        iconSize: [50, 50],
                                        iconAnchor: [50, 50],
                                        popupAnchor: [-20, -42]
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

<style>
.property-details .detail-item {
    font-size: 14px;
    color: #666;
}

.price-and-actions .actions a {
    color: #666;
    text-decoration: none;
    font-size: 16px;
    margin-left: 10px;
}

.price-and-actions .actions a:hover {
    color: #274abb;
}

.homes-content h3 a {
    text-decoration: none;
}

.homes-content h3 a:hover {
    color: #274abb;
}

.homes-address a {
    text-decoration: none;
}

.homes-address span {
    color: #666;
    font-size: 14px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

.landscapes {
    transition: transform 0.3s ease;
}

.landscapes:hover {
    transform: translateY(-5px);
}

.gap-4 {
    gap: 1.5rem;
}

.homes-address a {
    text-decoration: none;
    color: #666;
}

.homes-address i.fa-map-marker {
    font-size: 16px;
    min-width: 14px;
}

.homes-address span {
    line-height: 1.4;
}

.property-details .detail-item {
    font-size: 14px;
    color: #666;
    display: flex;
    align-items: center;
}

.property-details .detail-item i {
    margin-right: 8px;
}

.content-heading {
    margin-bottom: auto;
}

.project-head {
    overflow: hidden;
}

.project-head .property-link {
    display: block;
    height: 100%;
    width: 100%;
    position: relative;
    text-decoration: none;
}

.project-head .image-container {
    height: 100%;
    width: 100%;
    position: relative;
}

.project-head .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0);
    transition: background 0.3s ease;
}

.project-head .property-link:hover .overlay {
    background: rgba(0, 0, 0, 0.2);
}

.project-head img {
    transition: transform 0.3s ease;
}

.project-head .property-link:hover img {
    transform: scale(1.05);
}

.status-tag:hover {
    opacity: 0.9;
}

.toast-notification {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #274abb;
    color: white;
    padding: 12px 24px;
    border-radius: 4px;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    animation: fadeInOut 2s ease;
    pointer-events: none;
}

@keyframes fadeInOut {
    0% { opacity: 0; transform: translate(-50%, 20px); }
    15% { opacity: 1; transform: translate(-50%, 0); }
    85% { opacity: 1; transform: translate(-50%, 0); }
    100% { opacity: 0; transform: translate(-50%, -20px); }
}

.actions a {
    cursor: pointer;
}

.actions a:hover {
    color: #274abb;
}

.property-type-icons {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    width: 100%;
    max-width: 400px;
    margin: 0 auto;
}

.property-type-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
    flex: 1;
    padding: 0.5rem;
    border-radius: 8px;
}

.property-type-icon:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.icon-wrapper {
    margin-bottom: 0.5rem;
}

.leaflet-style-icon {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.leaflet-style-icon i {
    font-size: 22px;
    color: #274abb;
}

.type-icon {
    width: 25px;
    height: 25px;
    object-fit: contain;
}

.property-type-icon:hover .leaflet-style-icon {
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
}

.property-type-icon.selected {
    background-color: rgba(255, 255, 255, 0.15);
}

.property-type-icon.selected .leaflet-style-icon {
    background: #274abb;
    transform: translateY(-2px);
    box-shadow: 0 3px 6px rgba(39, 74, 187, 0.25);
}

.property-type-icon.selected .leaflet-style-icon i {
    color: white;
}

.icon-label {
    font-size: 13px;
    font-weight: 500;
    text-align: center;
    color: white;
    margin-top: 0.4rem;
    line-height: 1.2;
    white-space: nowrap;
}

.property-type-icon.selected .icon-label {
    color: white;
    font-weight: 600;
}

.custom-div-icon {
    background: none;
    border: none;
}

.marker-pin {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.blue-marker {
    background: #274abb;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.marker-pin i {
    font-size: 14px;
    color: white;
}

.marker-pin img.white-icon {
    width: 16px;
    height: 16px;
    object-fit: contain;
    filter: brightness(0) invert(1);
}

.marker-pin:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.leaflet-div-icon {
    background: #274abb;
    border: none;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.leaflet-div-icon i {
    color: white;
    font-size: 20px;
    line-height: 50px;
    margin-left: 15px;
}

.marker-icon {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.marker-icon img {
    width: 25px;
    height: 25px;
    filter: brightness(0) invert(1); /* Makes the icon white */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const shareButtons = document.querySelectorAll('.share-link');
    const toast = document.getElementById('toast');

    shareButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.value = url;
            document.body.appendChild(tempInput);
            
            // Select and copy the text
            tempInput.select();
            document.execCommand('copy');
            
            // Remove the temporary input
            document.body.removeChild(tempInput);
            
            // Show the toast notification
            toast.style.display = 'block';
            
            // Remove the toast after animation
            setTimeout(() => {
                toast.style.display = 'none';
            }, 2000);
        });
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const icons = document.querySelectorAll('.property-type-icon');
        const input = document.getElementById('selected-property-type');
        
        icons.forEach(icon => {
            icon.addEventListener('click', function() {
                // If this icon is already selected, deselect it
                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    input.value = ''; // Clear the input value
                } else {
                    // Remove selected class from all icons
                    icons.forEach(i => i.classList.remove('selected'));
                    
                    // Add selected class to clicked icon
                    this.classList.add('selected');
                    
                    // Update hidden input value
                    input.value = this.dataset.type;
                }
            });
        });
    });
</script>
