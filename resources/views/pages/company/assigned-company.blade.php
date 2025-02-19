@extends('layouts.userpanel')
@section('title', $title)

@section('content')

<div class="dashborad-box mb-0">
    <div class="widget-boxed-header">
        <h4>Societate imobiliară</h4>
    </div>
    @if($company)

    <section class="blog blog-section portfolio single-proper details mb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="news-item news-item-sm">
                                <a href="" class="news-img-link">
                                    <div class="news-item-img homes">
                                        <div class="homes-tag button alt featured">{{ $company->properties->count() }} Listings</div>
                                        <img class="resp-img" src="{{ asset('images/partners/' . $company->image) }}" alt="Company Image">
                                    </div>
                                </a>
                                <div class="news-item-text">
                                    <a href=""><h3>{{ $company->name }}</h3></a>
                                    <div class="the-agents">
                                        <ul class="the-agents-details">
                                            <li><a href="#">Office: {{ $company->address }}</a></li>
                                            <li><a href="#">Mobile: {{ $company->mobile_phone }}</a></li>
                                            <li><a href="#">Email: {{ $company->email }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="news-item-bottom">
                                        <a href="{{ route('properties.index') }}" class="news-link">View My Listings</a>
                                        <div class="admin">
                                            <p>{{ $company->leader->name }}</p>
                                            <img src="{{ asset('images/testimonials/' . $company->leader->image) }}" alt="Leader Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
        <p>Momentan nu ești membru într-o societate imobiliară.</p>
        <div class="add-property-button">
            <div class="row">
                <div class="col-md-12">
                    <div class="prperty-submit-button">
                        <button id="create-property-btn" style= "text-transform: none;"type="submit">Alătură-te unei societăți</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>

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
@endsection
