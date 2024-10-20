@extends('layouts.app')
@section('title', $title)

@section('content')
<section class="properties-right featured portfolio blog pt-5">
    <div class="container">
       <section class="headings-2 pt-0 pb-55">
            <div class="pro-wrapper">
                <div class="detail-wrapper-body">
                    <div class="listing-title-bar">
                        <div class="text-heading text-left">
                            <p class="pb-2"><a href="index.html">Acasă </a> &nbsp;/&nbsp; <span>Agenți</span></p>
                        </div>
                        <h3>Agenți imobiliari</h3>
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
                                    <p class="font-weight-bold mb-0 mt-3">{{ $agents->count() }} Search results</p>
                                </div>
                            </div>
                        </div>
                        <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid">
                            <div class="input-group border rounded input-group-lg w-auto mr-4">
                                <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01">
                                    <i class="fas fa-align-left fs-16 pr-2"></i>Sort by:
                                </label>
                                <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="inputGroupSelect01" name="sortby">
                                    <option selected>Alphabet</option>
                                    <option value="1">Random</option>
                                    <option value="2">Rating</option>
                                    <option value="3">Number of properties</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    @foreach ($agents as $agent)
                        <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                            <div class="project-single">
                                <div class="project-inner project-head">
                                    <div class="homes">
                                        <!-- homes img -->
                                        <a href="{{ route('user.properties', $agent->id) }}" class="homes-img">
                                            <div class="homes-tag button alt featured">{{ $agent->properties_count }} Listings</div>
                                            <img src="{{ asset('img/users/' . $agent->image) }}" alt="{{ $agent->name }}" class="img-responsive">
                                        </a>
                                    </div>
                                </div>
                                <!-- homes content -->
                                <div class="homes-content">
                                    <!-- homes address -->
                                    <div class="the-agents">
                                        <h3><a href="{{ route('user.properties', $agent->id) }}">{{ $agent->name }}</a></h3>
                                        <ul class="the-agents-details">
                                            <li><a href="#">Office: {{ $agent->office_phone }}</a></li>
                                            <li><a href="#">Mobile: {{ $agent->mobile_phone }}</a></li>
                                            <li><a href="#">Fax: {{ $agent->fax }}</a></li>
                                            <li><a href="#">Email: {{ $agent->email }}</a></li>
                                        </ul>
                                    </div>
                                    <div class="footer">
                                        <span class="view-my-listing">
                                            <a href="{{ route('user.properties', $agent->id) }}">View My Listings</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <nav aria-label="..." class="pt-55">
            {{ $agents->links() }} <!-- Add pagination here -->
        </nav>
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
<script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('js/lightcase.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/light.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/popup.js') }}"></script>
<script src="{{ asset('js/searched.js') }}"></script>
<script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/newsletter.js') }}"></script>
<script src="{{ asset('js/timedropper.js') }}"></script>
<script src="{{ asset('js/datedropper.js') }}"></script>
<script src="{{ asset('js/jqueryadd-count.js') }}"></script>
<script src="{{ asset('js/inner.js') }}"></script>
<script src="{{ asset('js/color-switcher.js') }}"></script>

@endsection
