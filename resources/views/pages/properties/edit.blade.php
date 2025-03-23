@extends('layouts.userpanel')
@section('title', 'Editare proprietate')

@section('includes-css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
<style>
    /* Hide the preloader */
    .preloader-inner, .preloader {
        display: none !important;
    }

    /* Dropzone styling */
    .dropzone {
        border: 2px dashed #0087F7;
        border-radius: 5px;
        background: white;
        min-height: 150px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .dropzone .dz-preview {
        position: relative;
        display: inline-block;
        margin: 10px;
        vertical-align: top;
    }

    .dropzone .dz-preview .dz-image {
        border-radius: 4px;
        overflow: hidden;
        width: 120px;
        height: 120px;
        position: relative;
        display: block;
        z-index: 10;
    }

    .dropzone .dz-preview .dz-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dropzone .dz-preview.main-photo {
        border: 3px solid #4CAF50;
        border-radius: 4px;
        padding: 3px;
    }

    .dz-preview .dz-image {
        margin-bottom: 10px;
    }

    .dz-preview .dz-details {
        text-align: center;
        margin-bottom: 10px;
    }

    .dz-preview .dz-buttons {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-top: 5px;
    }

    .dz-set-main-btn {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 12px;
        margin-top: 5px;
    }

    .dz-remove {
        background-color: #f44336;
        color: white !important;
        text-decoration: none !important;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        display: inline-block;
        margin-top: 5px;
    }

    .dz-set-main-btn:hover {
        background-color: #45a049;
    }

    .dz-remove:hover {
        background-color: #da190b;
    }

    /* Hide duplicate buttons */
    .dz-preview .Set.as.Main,
    .dz-preview .Remove.file {
        display: none !important;
    }

    .map-container {
        position: relative;
        width: 100%;
        height: 500px;
        overflow: hidden;
        box-sizing: border-box;
        border: 1px solid #ddd;
        background-color: #f0f0f0;
        margin-top: 15px;
    }

    #map-leaflet {
        width: 100%;
        height: 100%;
        z-index: 1;
        border-radius: 10px;
    }

    .dz-preview {
        display: inline-block;
        margin-right: 10px;
        vertical-align: top;
    }

    .dz-image img {
        max-width: 150px;
        height: auto;
    }

    .dz-preview-container {
        display: flex;
        flex-wrap: wrap;
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
    }

    .dz-set-main-btn:hover,
    .dz-delete-btn:hover {
        opacity: 0.8;
    }

    .main-photo {
        border: 2px solid #4CAF50;
        background-color: #f0f0f0;
    }

    .prperty-submit-button {
        display: flex;
        justify-content: center;
    }
</style>
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form id="property-form" action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Property Description Section -->
    <div class="single-add-property">
        <h3>Descrierea proprietății</h3>
        <div class="property-form-group">
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <label for="title">Titlul proprietății</label>
                        <input type="text" name="title" id="title" value="{{ $property->title }}" placeholder="Introduceți titlul anunțului">
                    </p>
                    <div class="alert alert-danger" id="title-error" style="display:none;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p>
                        <label for="description">Descriere</label>
                        <textarea id="description" name="description" placeholder="Descrieți proprietatea dvs">{{ $property->description }}</textarea>
                    </p>
                    <div class="alert alert-danger" id="description-error" style="display:none;"></div>
                </div>
            </div>

            <!-- Dropdowns for Property Status, Type, and Rooms -->
            <div class="row">
                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                    <div class="form-group categories">
                        <label for="status_id">Status</label>
                        <select name="status_id" class="form-control wide">
                            @foreach ($propertyStatuses as $propertyStatus)
                                @if ($propertyStatus->name != 'Vândut')
                                    <option value="{{ $propertyStatus->id }}" {{ $property->status_id == $propertyStatus->id ? 'selected' : '' }}>
                                        {{ $propertyStatus->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="alert alert-danger" id="status-error" style="display:none;"></div>
                </div>
                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                    <div class="form-group categories">
                        <label for="type_id">Tip</label>
                        <select name="type_id" class="form-control wide">
                            @foreach ($propertyTypes as $propertyType)
                                <option value="{{ $propertyType->id }}" {{ $property->type_id == $propertyType->id ? 'selected' : '' }}>
                                    {{ $propertyType->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="alert alert-danger" id="type-error" style="display:none;"></div>
                </div>

                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                    <div class="form-group categories">
                        <label for="bedrooms">Camere</label>
                        <select name="bedrooms" class="form-control wide">
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ $property->bedrooms == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
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
                        <input type="text" name="price" placeholder="EUR" id="price" value="{{ $property->price }}">
                    </p>
                    <div class="alert alert-danger" id="price-error" style="display:none;"></div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <p class="no-mb last">
                        <label for="size">Suprafață utilă</label>
                        <input type="text" name="size" placeholder="m2" id="size" value="{{ $property->size }}">
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
                            @foreach(['0-1', '0-5', '0-10', '0-15', '0-20', '0-50', '50+'] as $ageRange)
                                <option value="{{ $ageRange }}" {{ $property->age == $ageRange ? 'selected' : '' }}>
                                    {{ $ageRange }} ani
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                    <div class="form-group categories">
                        <label for="garages">Garaje</label>
                        <select name="garages" class="form-control wide">
                            <option value=""></option>
                            @for ($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ $property->garages == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 dropdown faq-drop">
                    <div class="form-group categories">
                        <label for="bathrooms">Băi</label>
                        <select name="bathrooms" class="form-control wide">
                            <option value=""></option>
                            @for ($i = 1; $i <= 6; $i++)
                                <option value="{{ $i }}" {{ $property->bathrooms == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
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
                    <input type="hidden" name="main_image" id="main_image" value="{{ $property->image }}">
                    <input type="hidden" name="property_id" id="property_id" value="{{ $property->id }}">
                    <div class="dz-preview-container">
                        <!-- Existing images will be loaded here via JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="prperty-submit-button">
        <button type="submit" class="btn btn-primary">Actualizează proprietatea</button>
    </div>
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
let dropzone = new Dropzone("#dropzone", {
    url: '{{ route('uploadImages') }}',
    autoProcessQueue: false,
    maxFilesize: 5,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    dictRemoveFile: 'Elimină',
    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i> Faceți clic aici sau plasați fișiere pentru a încărca",
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    init: function() {
        this.element.classList.remove('dz-started');
        this.element.classList.remove('dz-processing');
        
        this.on('sending', function(file, xhr, formData) {
            let propertyId = document.getElementById('property_id').value;
            formData.append('property_id', propertyId);
        });

        this.on('success', function(file, response) {
            file.filename = response.filename;
            this.element.classList.remove('dz-processing');
            
            // Add set as main button if it doesn't exist
            if (!file.previewElement.querySelector('.dz-set-main-btn')) {
                let setMainButton = document.createElement('button');
                setMainButton.className = 'dz-set-main-btn';
                setMainButton.innerHTML = 'Imagine Principală';
                setMainButton.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    setMainImage(file);
                };
                file.previewElement.appendChild(setMainButton);
            }
        });

        this.on('error', function(file, response) {
            this.element.classList.remove('dz-processing');
        });

        this.on('addedfile', function(file) {
            // Add set as main button if it doesn't exist
            if (!file.previewElement.querySelector('.dz-set-main-btn')) {
                let setMainButton = document.createElement('button');
                setMainButton.className = 'dz-set-main-btn';
                setMainButton.innerHTML = 'Imagine Principală';
                setMainButton.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    setMainImage(file);
                };
                file.previewElement.appendChild(setMainButton);
            }

            // Set first image as main if none is set
            if (this.files.length === 1) {
                setMainImage(file);
            }
        });

        // Handle file removal
        this.on('removedfile', function(file) {
            let propertyId = document.getElementById('property_id').value;
            let filename = file.name || file.filename;
            
            fetch('{{ route('deleteImage') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    property_id: propertyId,
                    filename: filename
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (document.getElementById('main_image').value === filename) {
                        if (this.files.length > 0) {
                            setMainImage(this.files[0]);
                        } else {
                            document.getElementById('main_image').value = '';
                        }
                    }
                }
            });
        });

        let dropzoneInstance = this;

        function setMainImage(file) {
            dropzoneInstance.files.forEach(function(f) {
                if (f.previewElement) {
                    f.previewElement.classList.remove("main-photo");
                }
            });

            if (file.previewElement) {
                file.previewElement.classList.add("main-photo");
            }

            let filename = file.name || file.filename;
            document.getElementById('main_image').value = filename;

            let propertyId = document.getElementById('property_id').value;
            fetch('{{ route('setMainImage') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    property_id: propertyId,
                    filename: filename
                })
            });
        }

        // Load existing images
        var propertyId = document.getElementById('property_id').value;
        if (propertyId) {
            var existingImages = {!! json_encode(array_map(
                function($file) { 
                    return [
                        'name' => basename($file),
                        'size' => filesize($file),
                        'path' => str_replace(public_path(), '', $file)
                    ]; 
                }, 
                glob(public_path('img/properties/' . $property->id . '/*.*')) ?: []
            )) !!};

            existingImages.forEach(function(file) {
                var mockFile = { 
                    name: file.name, 
                    size: file.size,
                    accepted: true
                };
                dropzoneInstance.emit("addedfile", mockFile);
                dropzoneInstance.emit("thumbnail", mockFile, file.path);
                dropzoneInstance.emit("complete", mockFile);
                
                // Add set as main button
                if (!mockFile.previewElement.querySelector('.dz-set-main-btn')) {
                    let setMainButton = document.createElement('button');
                    setMainButton.className = 'dz-set-main-btn';
                    setMainButton.innerHTML = 'Imagine Principală';
                    setMainButton.onclick = function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        setMainImage(mockFile);
                    };
                    mockFile.previewElement.appendChild(setMainButton);
                }

                // Mark as main photo if it is the main image
                if (file.name === document.getElementById('main_image').value) {
                    mockFile.previewElement.classList.add('main-photo');
                }

                dropzoneInstance.files.push(mockFile);
            });
        }

        this.on('processing', function() {
            this.element.classList.add('dz-processing');
        });

        this.on('queuecomplete', function() {
            this.element.classList.remove('dz-processing');
            this.element.classList.remove('dz-started');
        });

        setTimeout(() => {
            this.element.classList.remove('dz-processing');
            this.element.classList.remove('dz-started');
            const preloader = document.querySelector('.preloader');
            const preloaderInner = document.querySelector('.preloader-inner');
            if (preloader) preloader.style.display = 'none';
            if (preloaderInner) preloaderInner.style.display = 'none';
        }, 500);
    }
});
</script>
@endsection
