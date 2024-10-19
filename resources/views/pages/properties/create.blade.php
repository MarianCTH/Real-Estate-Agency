@extends('layouts.userpanel')
@section('title', $title)

@section('includes-css')
    <style>
        .map-container {
            position: relative;
            width: 100%;
            height: 500px;
            overflow: hidden;
            box-sizing: border-box;
            border: 1px solid #ddd;
            /* Add a border to the map container */
            background-color: #f0f0f0;
            /* Optional: add a background color to ensure visibility */
            margin-top: 15px;
        }

        #map-leaflet {
            width: 100%;
            height: 100%;
            z-index: 1;
            border-radius: 10px;
            /* Match the border radius for smooth edges */
        }

        /* Container that holds the previews */
        .dz-preview {
            display: inline-block;
            /* Display each preview inline */
            margin-right: 10px;
            /* Add some space between previews */
            vertical-align: top;
            /* Align previews to the top */
        }

        /* Additional optional styling */
        .dz-image img {
            max-width: 150px;
            /* Adjust the width of the thumbnail */
            height: auto;
            /* Maintain aspect ratio */
        }

        /* To make the container responsive and wrap */
        .dz-preview-container {
            display: flex;
            flex-wrap: wrap;
            /* Makes the previews wrap to the next line if there's not enough space */
        }

        .dz-buttons {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .dz-set-main-btn,
        .dz-delete-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .dz-delete-btn {
            background-color: #f44336;
            /* Red color for delete button */
        }

        .dz-set-main-btn:hover,
        .dz-delete-btn:hover {
            opacity: 0.8;
        }

        /* Highlight the main photo preview */
        .main-photo {
            border: 2px solid #4CAF50;
            background-color: #f0f0f0;
        }

        .prperty-submit-button {
            display: flex;
            justify-content: center;
            /* Centers horizontally */
        }
    </style>
@endsection

@section('content')
    <form id="property-form" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Property Description Section -->
        <div class="single-add-property">
            <h3>Descrierea proprietății</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="title">Titlul proprietății</label>
                            <input type="text" name="title" id="title" placeholder="Introduceți titlul anunțului">
                        </p>
                        <div class="alert alert-danger" id="title-error" style="display:none;"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="description">Descriere</label>
                            <textarea id="description" name="description" placeholder="Descrieți proprietatea dvs"></textarea>
                        </p>
                        <div class="alert alert-danger" id="description-error" style="display:none;"></div>
                    </div>
                </div>

                <!-- Dropdowns for Property Status, Type, and Rooms -->
                <div class="row">
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <label for="status">Status</label>
                            <select name="status" class="form-control wide">
                                <option value="vanzare">De vânzare</option>
                                <option value="inchiriat">De închiriat</option>
                            </select>
                        </div>
                        <div class="alert alert-danger" id="status-error" style="display:none;"></div>

                    </div>
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <label for="type_id">Tip</label>
                            <select name="type_id" class="form-control wide">
                                @foreach ($propertyTypes as $propertyType)
                                    <option value="{{ $propertyType->id }}">{{ $propertyType->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-danger" id="type-error" style="display:none;"></div>

                    </div>

                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <label for="status">Camere</label>
                            <select name="bedrooms" class="form-control wide">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="alert alert-danger" id="bedrooms-error" style="display:none;"></div>

                    </div>
                </div>

                <!-- Price and Area Fields -->
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb">
                            <label for="price">Preț</label>
                            <input type="text" name="price" placeholder="EUR" id="price">
                        </p>
                        <div class="alert alert-danger" id="price-error" style="display:none;"></div>

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb last">
                            <label for="size">Suprafață utilă</label>
                            <input type="text" name="size" placeholder="m2" id="size">
                        </p>
                        <div class="alert alert-danger" id="size-error" style="display:none;"></div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Optional Information Section -->
        <div class="single-add-property">
            <h3>Informații opționale</h3>
            <div class="property-form-group">
                <div class="row">
                    <!-- Age, Rooms, and Bathrooms Dropdowns -->
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <label for="age">An construcție</label>

                            <select name="age" class="form-control wide">
                                <option value=""></option>
                                <option value="0-1">0-1 ani</option>
                                <option value="0-5">0-5 ani</option>
                                <option value="0-10">0-10 ani</option>
                                <option value="0-15">0-15 ani</option>
                                <option value="0-20">0-20 ani</option>
                                <option value="0-50">0-50 ani</option>
                                <option value="50+">50+ ani</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <label for="garages">Garaje</label>

                            <select name="garages" class="form-control wide">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 dropdown faq-drop">
                        <div class="form-group categories">
                            <label for="bathrooms">Băi</label>
                            <select name="bathrooms" class="form-control wide">
                                <option value=""></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="single-add-property">
            <h3>Imagini de prezentare</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-md-12">
                        <div id="dropzone" class="dropzone"></div>
                        <input type="hidden" name="main_image" id="main_image" value="">

                        <input type="hidden" name="property_id" id="property_id" value="">
                        <div class="dz-preview-container">
                            <!-- Dropzone will append preview items here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Property Location Section -->
        <div class="single-add-property">
            <h3>Locația proprietății</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p>
                            <label for="location">Adresă</label>
                            <input type="text" name="location" placeholder="Adresa proprietății" id="location">
                        </p>
                        <div class="alert alert-danger" id="location-error" style="display:none;"></div>

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p>
                            <label for="city">Oraș</label>
                            <input type="text" name="city" placeholder="ex. Bistrita" id="city">
                        </p>
                        <div class="alert alert-danger" id="city-error" style="display:none;"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12" style="display:none;">
                        <p class="no-mb first">
                            <label for="latitude">Latitudine Google Maps</label>
                            <input type="text" name="latitude" placeholder="Latitudine Google Maps" id="latitude">
                        </p>
                        <div class="alert alert-danger" id="latitude-error" style="display:none;"></div>

                    </div>
                    <div class="col-lg-6 col-md-12" style="display:none;">
                        <p class="no-mb last">
                            <label for="longitude">Longitudine Google Maps</label>
                            <input type="text" name="longitude" placeholder="Longitudine Google Maps" id="longitude">
                        </p>
                        <div class="alert alert-danger" id="longitude-error" style="display:none;"></div>

                    </div>
                    <div class="col-lg-12 col-md-12 text-center pt-3">
                        Selectați locația proprietății pe hartă doar în aria județului Bistrița-Năsăud.
                    </div>
                </div>
                <div class="map-container">
                    <div id="map-leaflet"></div>
                </div>
            </div>
        </div>

        <!-- Contact Information Section -->
        <div class="single-add-property">
            <h3>Informații de contact</h3>
            <div class="property-form-group">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p>
                            <label for="con-name">Nume</label>
                            <input type="text" placeholder="Introduceți numele" id="con-name" name="con-name"
                                value="{{ old('con-name', $user->name ?? '') }}">
                        </p>
                        <div class="alert alert-danger" id="con-name-error" style="display:none;"></div>

                    </div>
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb first">
                            <label for="con-email">Email</label>
                            <input type="email" placeholder="Introduceți email-ul" id="con-email" name="con-email"
                                value="{{ old('con-email', $user->email) }}">
                        </p>
                        <div class="alert alert-danger" id="con-email-error" style="display:none;"></div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <p class="no-mb last">
                            <label for="con-phn">Telefon</label>
                            <input type="text" placeholder="Număr de telefon" id="con-phn" name="con-phn"
                                value="{{ old('con-phn', $userDetails->phone ?? '') }}">
                        </p>
                        <div class="alert alert-danger" id="con-phn-error" style="display:none;"></div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="add-property-button pt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="prperty-submit-button">
                        <button id="create-property-btn" type="submit">Postează anunțul</button>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </form>

@endsection

@section('includes-js')
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/swiper.min.js') }}"></script>
    <script src="{{ asset('js/swiper.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/slick2.js') }}"></script>
    <script src="{{ asset('js/fitvids.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('js/lightcase.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}"></script>
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/searched.js') }}"></script>
    <script src="{{ asset('js/dashbord-mobile-menu.js') }}"></script>
    <script src="{{ asset('js/forms-2.js') }}"></script>
    <script src="{{ asset('js/color-switcher.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/leaflet.js') }}"></script>
    <script src="{{ asset('js/leaflet-gesture-handling.min.js') }}"></script>
    <script src="{{ asset('js/leaflet-providers.js') }}"></script>
    <script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
    <script src="{{ asset('js/leaflet.snogylop.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var mapContainer = document.getElementById('map-leaflet');

            if (mapContainer) {
                // Initialize Leaflet map
                var map = L.map('map-leaflet').setView([47.1371, 24.5024], 9.5);

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

                // Fetch the GeoJSON data for the region
                fetch('/geojson/bistrita_nasaud.geojson')
                    .then(response => response.json())
                    .then(region => {
                        // Check if the region data has geometry and coordinates
                        if (region.geometry && region.geometry.type === 'Polygon' &&
                            region.geometry.coordinates && Array.isArray(region.geometry.coordinates)) {

                            // Get the coordinates of the first polygon (assuming single polygon)
                            var coordinates = region.geometry.coordinates[0];

                            // Convert coordinates from [lon, lat] to [lat, lon]
                            var regionPolygon = coordinates.map(point => [point[1], point[0]]);

                            // Add the polygon to the map
                            L.polygon(regionPolygon, {
                                color: 'blue', // Boundary color
                                weight: 2,
                                fillColor: 'blue', // Inside fill color
                                fillOpacity: 0.1
                            }).addTo(map);

                            // Function to check if a point is inside the polygon
                            function inside(point, vs) {
                                var x = point.lat,
                                    y = point.lng;

                                var inside = false;
                                for (var i = 0, j = vs.length - 1; i < vs.length; j = i++) {
                                    var xi = vs[i][0],
                                        yi = vs[i][1];
                                    var xj = vs[j][0],
                                        yj = vs[j][1];

                                    var intersect = ((yi > y) != (yj > y)) &&
                                        (x < (xj - xi) * (y - yi) / (yj - yi) + xi);
                                    if (intersect) inside = !inside;
                                }

                                return inside;
                            }

                            // Add click event to place marker
                            var marker;
                            map.on('click', function(e) {
                                var latlng = e.latlng;

                                // Check if the clicked point is inside the Bistrița-Năsăud region
                                if (inside(latlng, regionPolygon)) {
                                    if (marker) {
                                        marker.setLatLng(latlng).update();
                                    } else {
                                        marker = L.marker(latlng, {
                                            draggable: true
                                        }).addTo(map);
                                    }

                                    // Set the latitude and longitude input fields
                                    document.getElementById('latitude').value = latlng.lat;
                                    document.getElementById('longitude').value = latlng.lng;

                                    // Update coordinates on marker drag
                                    marker.on('dragend', function(event) {
                                        var markerLatLng = event.target.getLatLng();
                                        document.getElementById('latitude').value = markerLatLng
                                            .lat;
                                        document.getElementById('longitude').value =
                                            markerLatLng.lng;
                                    });
                                } else {
                                    alert(
                                        "Poti plasa markerul doar pe raza județului Bistrița-Năsăud."
                                    );
                                }
                            });

                        } else {
                            console.error('GeoJSON does not have the expected structure.');
                        }
                    })
                    .catch(error => console.error('Error fetching GeoJSON:', error));
            }
        });
    </script>

    <script>
        let dropzone = new Dropzone("#dropzone", {
            url: '{{ route('uploadImages') }}', // Upload route
            autoProcessQueue: false, // Do not auto-upload images
            maxFilesize: 5, // MB
            acceptedFiles: 'image/*',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            init: function() {
                this.on('sending', function(file, xhr, formData) {
                    let propertyId = document.getElementById('property_id').value;
                    formData.append('property_id', propertyId); // Add property_id to the formData
                });
                this.on('success', function(file, response) {
                        file.filename = response.filename; // Store filename in the file object
                        console.log('Image uploaded successfully:', response.filename);
                });
                this.on('error', function(file, response) {
                    console.error('Image upload error:', response);
                });
                let dropzoneInstance = this;

                dropzoneInstance.on('addedfile', function(file) {
                    if (dropzoneInstance.files.length === 1) {
                        setMainImage(file);
                    }

                });

                function setMainImage(file) {
                    dropzoneInstance.files.forEach(function(f) {
                        if (f.previewElement) {
                            f.previewElement.classList.remove("main-photo");
                        }
                    });

                    if (file.previewElement) {
                        file.previewElement.classList.add("main-photo");
                    }

                    document.getElementById('main_image').value = file.name;
                }
            }
        });
    </script>

    <script>
        document.getElementById('create-property-btn').addEventListener('click', function(event) {
            event.preventDefault();
            let formData = new FormData(document.getElementById('property-form'));
            console.log(formData)
            $.ajax({
                url: "{{ route('properties.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.property_id) {
                        document.getElementById('property_id').value = response.property_id;

                        tempId = response.property_id;
                        dropzone.processQueue();

                        let successMessage = document.createElement('div');
                        successMessage.className = 'alert alert-success';
                        successMessage.textContent = 'Property added successfully!';
                        document.querySelector('.add-property-button').prepend(successMessage);

                        setTimeout(function() {
                            window.location.href =
                                "{{ route('my-properties') }}";
                        }, 2000); // Redirect after 2 seconds
                    }
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;

                    // Display errors
                    if (errors) {
                        Object.keys(errors).forEach(function(key) {
                            let errorElement = document.getElementById(`${key}-error`);
                            if (errorElement) {
                                errorElement.textContent = errors[key][
                                    0
                                ]; // Show first validation error
                                errorElement.style.display =
                                    'block'; // Display the error message container
                            }
                        });
                    }
                }
            });
        });
    </script>
@endsection
