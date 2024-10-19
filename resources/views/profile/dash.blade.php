@extends('layouts.userpanel')
@section('title', $title)

@section('content')
<div class="dashborad-box stat bg-white">
    <h4 class="title">Administrează Tabloul de Bord</h4>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-xs-12 dar pro mr-3">
                <div class="item">
                    <div class="icon">
                        <i class="fa fa-list" aria-hidden="true"></i>
                    </div>
                    <div class="info">
                        <h6 class="number">{{ $publishedPropertiesCount }}</h6>
                        <p class="type ml-1">Proprietăți Publicate</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-xs-12 dar rev mr-3">
                <div class="item">
                    <div class="icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="info">
                        <h6 class="number">{{ $totalViewsCount }}</h6>
                        <p class="type ml-1">Vizualizări totale</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 dar com mr-3">
                <div class="item mb-0">
                    <div class="icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <div class="info">
                        <h6 class="number">0</h6>
                        <p class="type ml-1">Mesaje</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 dar booked">
                <div class="item mb-0">
                    <div class="icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="info">
                        <h6 class="number">0</h6>
                        <p class="type ml-1">Număr de ori adăugat la Favorite</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="dashborad-box">
    <h4 class="title">Listări</h4>
    <div class="section-body listing-table">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Numele Listării</th>
                        <th>Data</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Editare</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Restaurant de Lux</td>
                        <td>23 Ian 2020</td>
                        <td class="rating"><span>5.0</span></td>
                        <td class="status"><span class="active">Activ</span></td>
                        <td class="edit"><a href="#"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Sala de Gimnastică din Oraș</td>
                        <td>11 Feb 2020</td>
                        <td class="rating"><span>4.5</span></td>
                        <td class="status"><span class="active">Activ</span></td>
                        <td class="edit"><a href="#"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td>Cafenea în Boston</td>
                        <td>09 Ian 2020</td>
                        <td class="rating"><span>5.0</span></td>
                        <td class="status"><span class="non-active">Inactiv</span></td>
                        <td class="edit"><a href="#"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                    <tr>
                        <td class="pb-0">Dealer Auto în New York</td>
                        <td class="pb-0">24 Feb 2018</td>
                        <td class="rating pb-0"><span>4.5</span></td>
                        <td class="status pb-0"><span class="active">Activ</span></td>
                        <td class="edit pb-0"><a href="#"><i class="fa fa-pencil"></i></a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
