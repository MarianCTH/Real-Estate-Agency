@extends('layouts.app')
@section('title', $title)

@section('content')
<section class="blog blog-section portfolio pt-5">
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
            <div class="col-lg-8 col-md-12 col-xs-12">
               <section class="headings-2 pt-0">
                    <div class="pro-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                                <div class="text-heading text-left">
                                    <p class="font-weight-bold mb-0 mt-3">{{ $agents->count() }} Agenți afișați în pagina curentă</p>
                                </div>
                            </div>
                        </div>
                        <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid">
                            <div class="input-group border rounded input-group-lg w-auto mr-4">
                                <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Sortează:</label>
                                <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="inputGroupSelect01" name="sortby">
                                    <option selected>Alfabet</option>
                                    <option value="1">Agenție</option>
                                    <option value="1">Numărul de proprietăți</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </section>
                <div class="row">
                    @foreach ($agents as $agent)
                    <div class="col-md-12 col-xs-12 {{ !$loop->first ? 'space' : '' }}">
                        <div class="news-item news-item-sm">
                            <a href="{{ route('user.properties', $agent->id) }}" class="news-img-link">
                                <div class="news-item-img homes">
                                    <div class="homes-tag button alt featured">{{ $agent->properties_count }} Listări</div>
                                    <img class="resp-img" src="{{ asset('img/users/' . $agent->image) }}" alt="blog image">
                                </div>
                            </a>
                            <div class="news-item-text">
                                <a href="{{ route('user.properties', $agent->id) }}"><h3>{{ $agent->name }}</h3></a>
                                <div class="the-agents">
                                    <ul class="the-agents-details">
                                        <li><a href="#">Office: {{ $agent->office_phone }}</a></li>
                                        <li><a href="#">Mobile: {{ $agent->mobile_phone }}</a></li>
                                        <li><a href="#">Fax: {{ $agent->fax }}</a></li>
                                        <li><a href="#">Email: {{ $agent->email }}</a></li>
                                        @if ($agent->company)
                                            <li><a href="#">Societate: {{ $agent->company->name }}</a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="news-item-bottom">
                                    <a href="{{ route('user.properties', $agent->id) }}" class="news-link">Vezi proprietăți</a>
                                    <div class="admin">
                                        @if ($agent->company)
                                            <img src="{{ asset($agent->company->image) }}" alt="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            <aside class="col-lg-4 col-md-12 car">
                <div class="single widget">
                    <div class="main-search-field-2">

                        <!-- Recent Properties -->
                        <div class="widget-boxed mt-5">
                            <div class="widget-boxed-header">
                                <h4>Postări Recente</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="recent-post">
                                    @foreach($recentProperties as $property)
                                    <div class="recent-main my-4">
                                        <div class="recent-img">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}">
                                                <img src="{{ asset('img/properties/' . $property->id . '/' . $property->image) }}" alt="{{ $property->title }}">
                                            </a>
                                        </div>
                                        <div class="info-img">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}">
                                            <h6>{{ $property->title }}</h6>
                                            </a>
                                            <p>${{ number_format($property->price, 0) }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if ($featuredProperties->isNotEmpty())
                            <div class="widget-boxed mt-5">
                                <div class="widget-boxed-header mb-5">
                                    <h4>Recomandări</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="slick-lancers">
                                        @foreach($featuredProperties as $property)
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="{{ route('property.show', ['id' => $property->id]) }}" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">${{ number_format($property->price, 0) }}</span>
                                                        <span>{{ $property->status->name }}</span> <!-- Sale / Rent -->
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title"><i>{{ $property->location }}</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>{{ $property->area }} sq ft</span></li>
                                                            <li>Rooms <span>{{ $property->rooms }}</span></li>
                                                            <li>Beds <span>{{ $property->beds }}</span></li>
                                                            <li>Baths <span>{{ $property->baths }}</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="{{ asset('img/properties/' . $property->id . '/' . $property->image) }}" alt="{{ $property->title }}">
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </aside>

        </div>
        <nav aria-label="..." class="pt-0">
            {{ $agents->links() }}
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
