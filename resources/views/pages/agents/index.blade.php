@extends('layouts.app')
@section('title', $title)

@section('content')
<style>
    .bootstrap-select .dropdown-menu {
        z-index: 9999 !important;
        position: absolute !important;
    }
    .bootstrap-select {
        position: relative !important;
    }
    .dropdown-menu {
        z-index: 9999 !important;
    }
    .selectpicker + .dropdown-menu {
        z-index: 9999 !important;
    }
</style>
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
                                    <form action="{{ route('agents') }}" method="GET" class="mb-0">
                                        <div class="input-group border rounded input-group-lg w-auto">
                                            <input type="text" name="search" class="form-control border-0 bg-transparent" placeholder="Caută agenți..." value="{{ request('search') }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="sortby" value="{{ request('sortby', 'name') }}">
                                        <input type="hidden" name="direction" value="{{ request('direction', 'asc') }}">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid">
                            <form action="{{ route('agents') }}" method="GET" class="d-flex align-items-center">
                                <input type="hidden" name="search" value="{{ request('search') }}">
                                <div class="input-group border rounded input-group-lg w-auto mr-4">
                                    <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01">
                                        <i class="fas fa-align-left fs-16 pr-2"></i>Sortează:
                                    </label>
                                    <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" 
                                            data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" 
                                            id="inputGroupSelect01" 
                                            name="sortby"
                                            onchange="this.form.submit()">
                                        <option value="name" {{ request('sortby') == 'name' ? 'selected' : '' }}>Nume</option>
                                        <option value="company" {{ request('sortby') == 'company' ? 'selected' : '' }}>Agenție</option>
                                        <option value="properties" {{ request('sortby') == 'properties' ? 'selected' : '' }}>Proprietăți</option>
                                    </select>
                                </div>
                                <input type="hidden" name="direction" value="{{ request('direction') == 'asc' ? 'desc' : 'asc' }}">
                            </form>
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
                                <h3>{{ $agent->name }}</h3>
                                <div class="the-agents">
                                    <ul class="list-unstyled mb-4" style="line-height: 2;">
                                        <li>
                                            <span class="la la-phone">
                                                <i class="fa fa-phone text-muted"></i>
                                            </span>
                                            <a href="tel:{{ $agent->userDetail->phone ?? '#' }}" class="text-dark">
                                                {{ $agent->userDetail->phone ?? 'Număr de telefon necompletat' }}
                                            </a>
                                        </li>
                                        <li>
                                            <span class="la la-envelope-o">
                                                <i class="fa fa-envelope text-muted"></i>
                                            </span>
                                            <a href="mailto:{{ $agent->email }}" class="text-dark">
                                                {{ $agent->email }}
                                            </a>
                                        </li>
                                        <li>
                                            <span class="la la-map-marker">
                                                <i class="fa fa-map-marker text-muted"></i>
                                            </span>
                                            <span class="text-dark">{{ $agent->userDetail->address ?? 'Adresa nu este setată' }}</span>
                                        </li>
                                        <li>
                                            <span class="la la-clock-o">
                                                <i class="fa fa-clock-o text-muted"></i>
                                            </span>
                                            <span class="text-dark">Membru din: {{ ucfirst(\Carbon\Carbon::parse($agent->created_at)->locale('ro')->isoFormat('MMMM YYYY')) }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('user.properties', $agent->id) }}" class="btn btn-primary px-4">
                                        Vezi proprietăți
                                    </a>
                                    @if ($agent->company)
                                        <img src="{{ asset($agent->company->image) }}" alt="{{ $agent->company->name }}" style="max-height: 35px;">
                                    @endif
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
                                    <div class="recent-main d-flex align-items-center py-3">
                                        <div class="recent-img" style="min-width: 120px;">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}" class="position-relative d-block">
                                                <img src="{{ asset('img/properties/' . $property->id . '/' . $property->image) }}" 
                                                     alt="{{ $property->title }}"
                                                     class="img-fluid rounded" 
                                                     style="width: 120px; height: 90px; object-fit: cover;">
                                                <div class="price-tag position-absolute bg-primary text-white px-2 py-1" 
                                                     style="font-size: 0.8rem; top: 5px; left: 5px; z-index: 1;">
                                                    ${{ number_format($property->price, 0) }}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="info-img ml-3 flex-grow-1">
                                            <a href="{{ route('property.show', ['id' => $property->id]) }}" class="text-decoration-none">
                                                <h6 class="text-dark mb-1" style="font-size: 0.95rem;">{{ Str::limit($property->title, 40) }}</h6>
                                            </a>
                                            <div class="location">
                                                <i class="fa fa-map-marker text-primary"></i>
                                                <small class="text-muted ml-1">{{ Str::limit($property->location, 30) }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @if(!$loop->last)
                                        <hr class="my-0">
                                    @endif
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
            {{ $agents->appends(request()->query())->links() }}
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
