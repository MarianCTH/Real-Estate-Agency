@extends('layouts.app')
@section('title', $title)

@section('content')
    <section class="properties-list featured portfolio blog">
        <div class="container">
            <section class="headings-2 pt-0">
                <div class="pro-wrapper">
                    <div class="detail-wrapper-body">
                        <div class="listing-title-bar">
                            <div class="text-heading text-left">
                                <p class="font-weight-bold mb-0 mt-3">{{ $properties->total() }} Anunțuri postate de
                                    {{ $company->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center">
                        <div class="input-group border rounded input-group-lg w-auto mr-4">
                            <form action="{{ route('agency.properties', ['company' => $company->id]) }}" method="GET" id="sortForm">
                                <div class="input-group border rounded input-group-lg w-auto mr-4">
                                    <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01">
                                        <i class="fas fa-align-left fs-16 pr-2"></i>Sortare:
                                    </label>
                                    <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby"
                                            id="inputGroupSelect01" name="sortby" onchange="document.getElementById('sortForm').submit();">
                                        <option value="normal" {{ request('sortby') == 'normal' ? 'selected' : '' }}>Normal</option>
                                        <option value="1" {{ request('sortby') == '1' ? 'selected' : '' }}>Cele mai vizualizate</option>
                                        <option value="2" {{ request('sortby') == '2' ? 'selected' : '' }}>Preț (crescător)</option>
                                        <option value="3" {{ request('sortby') == '3' ? 'selected' : '' }}>Preț (descrescător)</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

            <div class="row">
                @foreach ($properties as $property)
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-up">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}" class="homes-img">
                                        <div class="homes-price">{{ $property->price }} EUR</div>
                                        <img src="{{ asset('img/properties/' . $property->id . '/' . $property->image) }}"
                                            alt="{{ $property->title }}" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                            <div class="homes-content">
                                <h3><a href="{{ route('property.show', ['id' => $property->id]) }}">{{ $property->title }}</a></h3>
                                <p class="homes-address mb-3">
                                    <a href="{{ route('property.show', ['id' => $property->id]) }}">
                                        <i class="fa fa-map-marker"></i><span>{{ $property->location }}</span>
                                    </a>
                                </p>
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
                                        <span>{{ $property->size }} m²</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <nav aria-label="..." class="pt-3">
                {{ $properties->links() }} <!-- Pagination links -->
            </nav>
        </div>
    </section>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/rangeSlider.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/aos2.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('js/lightcase.js') }}"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/light.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/popup.js') }}"></script>
    <script src="{{ asset('js/searched.js') }}"></script>
    <script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}"></script>
    <script src="{{ asset('js/inner.js') }}"></script>
    <script src="{{ asset('js/color-switcher.js') }}"></script>

    <script>
        $(".dropdown-filter").on('click', function() {

            $(".explore__form-checkbox-list").toggleClass("filter-block");

        });
    </script>
@endsection
