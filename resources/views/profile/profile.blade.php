@extends('layouts.userpanel')
@section('title', $title)

@section('content')

<div class="dashborad-box mb-0">
    <div class="widget-boxed-header">
        <h4>Detaliile profilului</h4>
    </div>
    <div class="sidebar-widget author-widget2">
        <div class="author-box clearfix">
            <img src="{{ asset('img/users/' . auth()->user()->image) }}" alt="imaginea autorului" class="author__img">
            <h4 class="author__title">{{ Auth::user()->name }}</h4>
            <p class="author__meta">Agent imobiliar</p>
        </div>
        <ul class="author__contact">
            <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>{{ $userDetails->address ?? 'Adresa nu este setată' }}</li>
            <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span>{{ $userDetails->phone ?? 'Număr de telefon necompletat' }}</li>
            <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span>{{ Auth::user()->email }}</li>
        </ul>
    </div>

    <h4 class="heading pt-5">Informații personale</h4>
    <div class="section-inforamation">
        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Prenume</label>
                        <input type="text" class="form-control" name="first_name" value="{{ Auth::user()->first_name }}" placeholder="Introduceți prenumele">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Nume de familie</label>
                        <input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Introduceți numele de familie">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Adresă de email</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" placeholder="Ex: exemplu@domeniu.com">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Număr de telefon</label>
                        <input type="text" class="form-control" name="phone" value="{{ !empty($userDetails->phone) ? $userDetails->phone : '' }}" placeholder="Ex: +40-700-000-000">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Adresă</label>
                        <textarea name="address" class="form-control" placeholder="Introduceți adresa">{{ !empty($userDetails->address) ? $userDetails->address : '' }}</textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Despre tine</label>
                        <textarea name="about" class="form-control" placeholder="Scrieți despre dvs.">{{ Auth::user()->about }}</textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-2">Actualizează</button>
        </form>
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
