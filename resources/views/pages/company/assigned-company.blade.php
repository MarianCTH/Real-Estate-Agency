@extends('layouts.userpanel')
@section('title', $title)

@section('content')

    <div class="dashborad-box mb-0">
        <div class="widget-boxed-header">
            <h4>Societate imobiliară</h4>
        </div>
        @if ($company)

        <section class="blog blog-section portfolio single-proper details mb-0">
            <div class="container d-flex justify-content-center">
                <div class="col-lg-10 col-md-12 col-xs-12">
                    <div class="col-md-12 col-xs-12">
                        <div class="news-item news-item-sm">
                            <a href="" class="news-img-link">
                                <div class="news-item-img homes">
                                    <div class="homes-tag button alt featured">
                                        {{ optional($company->properties)->count() ?? 0 }} Postări
                                    </div>
                                    <img class="resp-img" src="{{ asset($company->image) }}" alt="Company Image">
                                </div>
                            </a>
                            <div class="news-item-text">
                                <a href="">
                                    <h3>{{ $company->name }}</h3>
                                </a>
                                <div class="the-agents">
                                    <ul class="the-agents-details">
                                        <li><a href="#">Adresă: {{ $company->address }}</a></li>
                                        <li><a href="#">Telefon: {{ $company->mobile_phone }}</a></li>
                                        <li><a href="#">Email: {{ $company->email }}</a></li>
                                    </ul>
                                </div>
                                <div class="news-item-bottom">
                                    <a href="{{ route('agency.properties', $company->id) }}" class="news-link">Vezi toate listările</a>
                                    <div class="admin">
                                        <p>{{ $company->leader->name }}</p>
                                        <img src="{{ asset('img/users/' . $company->leader->image) }}" alt="Leader Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class = "d-flex justify-content-center">
                        @if(auth()->user()->id !== $company->leader_id)
                        <form action="{{ route('companies.leave') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Sigur vrei să părăsești această societate?')">Părăsește societatea</button>
                        </form>
                        <a href="{{ route('companies.members', $company->id) }}" class="btn btn-primary">Vezi membri</a>
                        @endif

                        @if(auth()->user()->id === $company->leader_id)
                        <div class="buttons">
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning" >Editează</a>

                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sigur vrei să ștergi această societate?')">Șterge</button>
                            </form>

                            <a href="{{ route('companies.members', $company->id) }}" class="btn btn-primary">Vizualizează membri</a>
                        </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </section>

        @else
            <div class="d-flex flex-column justify-content-center align-items-center text-center">
                <p>Momentan nu ești membru într-o societate imobiliară.</p>
                <div class="add-property-button">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="prperty-submit-button">
                                <button class="btn btn-primary" style="text-transform: none;"
                                    onclick="window.location.href='{{ route('companies.assign') }}'">
                                    Alătură-te unei societăți
                                </button>

                                <button class="btn btn-primary" style="text-transform: none;"
                                    onclick="window.location.href='{{ route('companies.create') }}'">
                                    Creează o societate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
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
