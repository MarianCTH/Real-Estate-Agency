@extends('layouts.userpanel')
@section('title', $title)

@section('content')
<section class="dashboard-section">
    <div class="container">
        <section class="headings-2 pt-0 pb-4">
            <div class="pro-wrapper">
                <div class="detail-wrapper-body">
                    <div class="listing-title-bar">
                        <div class="text-heading text-left">
                            <p class="pb-2"><a href="{{ route('welcome') }}">Acasă </a> &nbsp;/&nbsp; <span>Membrii Societății</span></p>
                        </div>
                        <h3>MEMBRII SOCIETĂȚII {{ strtoupper($company->name) }}</h3>
                    </div>
                </div>
            </div>
        </section>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="dashborad-box mb-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="widget-boxed-header d-flex justify-content-between align-items-center">
                        <h4>Membrii Activi</h4>
                        @if(auth()->id() === $company->leader_id)
                            <a href="{{ route('companies.add-member', $company->id) }}" class="btn" style="background-color: #274abb; color: white; padding: 8px 16px; border-radius: 5px; font-weight: 500;">
                                <i class="fa fa-plus mr-1"></i> Adaugă membru
                            </a>
                        @endif
                    </div>
                    <div class="widget-boxed-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Membru</th>
                                        <th>Informații</th>
                                        <th>Data Înregistrării</th>
                                        <th>Anunțuri</th>
                                        <th>Acțiuni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($company->members as $member)
                                    <tr>
                                        <td style="width: 100px;">
                                            <div class="agent-photo">
                                                <a href="{{ route('user.properties', $member->id) }}">
                                                    <img src="{{ asset('img/users/' . $member->image) }}" 
                                                         alt="{{ $member->name }}" 
                                                         class="img-fluid rounded-circle" 
                                                         style="width: 80px; height: 80px; object-fit: cover;">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="agent-info">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('user.properties', $member->id) }}" class="text-dark">
                                                        {{ $member->name }}
                                                    </a>
                                                </h6>
                                                <p class="text-muted mb-0">
                                                    <i class="fa fa-map-marker text-primary mr-1"></i>
                                                    {{ $member->userDetail->address ?? 'Adresa nu este setată' }}
                                                </p>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($member->created_at)->format('d.m.Y') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="announcements-count">
                                                    <span class="badge" style="background-color: #274abb; color: white; padding: 6px 12px; border-radius: 50px; font-size: 13px; font-weight: 500;">
                                                        {{ $member->properties()->count() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if(auth()->id() === $company->leader_id && $member->id !== $company->leader_id)
                                                <form action="{{ route('companies.members.remove', [$company->id, $member->id]) }}" 
                                                      method="POST" 
                                                      onsubmit="return confirm('Sunteți sigur că doriți să eliminați acest membru?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash mr-1"></i> Elimină
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
