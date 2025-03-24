@extends('layouts.userpanel')
@section('title', $title)

@section('content')

<div class="dashborad-box mb-0">
    <div class="widget-boxed-header">
        <h4>Detaliile profilului</h4>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="sidebar-widget author-widget2">
        <div class="author-box clearfix">
            <img src="{{ asset('img/users/' . auth()->user()->image) }}" alt="imaginea autorului" class="author__img">
            <h4 class="author__title">{{ Auth::user()->name }}</h4>
            <p class="author__meta">{{ Auth::user()->type }}</p>
        </div>
        <ul class="author__contact">
            <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>{{ $userDetails->address ?? 'Adresa nu este setată' }}</li>
            <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span>{{ $userDetails->phone ?? 'Număr de telefon necompletat' }}</li>
            <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span>{{ Auth::user()->email }}</li>
        </ul>
    </div>

    <h4 class="heading pt-5">Informații personale</h4>
    <div class="section-inforamation">
        <form action="{{ route('profile.update') }}" method="POST" id="profile-form">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Nume complet</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               name="name" 
                               value="{{ old('name', Auth::user()->name) }}" 
                               placeholder="Introduceți numele complet">
                        @error('name')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Adresă de email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email', Auth::user()->email) }}" 
                               placeholder="Ex: exemplu@domeniu.com">
                        @error('email')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Număr de telefon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               name="phone" 
                               value="{{ old('phone', $userDetails->phone ?? '') }}" 
                               placeholder="Ex: +40-700-000-000">
                        @error('phone')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Tip utilizator</label>
                        <input type="text" 
                               class="form-control" 
                               value="{{ Auth::user()->type }}" 
                               disabled>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Adresă</label>
                        <textarea name="address" 
                                  class="form-control @error('address') is-invalid @enderror" 
                                  placeholder="Introduceți adresa">{{ old('address', $userDetails->address ?? '') }}</textarea>
                        @error('address')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div id="validation-message" class="alert alert-danger mt-2" style="display: none;"></div>

            <div class="prperty-submit-button">
                <button type="submit" class="btn btn-primary btn-lg">Actualizează</button>
            </div>
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
    <script>
        document.getElementById('profile-form').addEventListener('submit', function(event) {
            var name = document.querySelector('input[name="name"]').value;
            var email = document.querySelector('input[name="email"]').value;
            var phone = document.querySelector('input[name="phone"]').value;
            var validationMessageDiv = document.getElementById('validation-message');
            var hasError = false;

            validationMessageDiv.style.display = 'none';
            validationMessageDiv.textContent = '';

            // Basic email validation regex
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            // Romanian phone number validation regex
            var phoneRegex = /^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/;

            if (!name) {
                validationMessageDiv.textContent = 'Numele este obligatoriu.';
                hasError = true;
            } else if (!email) {
                validationMessageDiv.textContent = 'Adresa de email este obligatorie.';
                hasError = true;
            } else if (!emailRegex.test(email)) {
                validationMessageDiv.textContent = 'Vă rugăm să introduceți o adresă de email validă.';
                hasError = true;
            } else if (phone && !phoneRegex.test(phone)) {
                validationMessageDiv.textContent = 'Vă rugăm să introduceți un număr de telefon valid (format românesc).';
                hasError = true;
            }

            if (hasError) {
                validationMessageDiv.style.display = 'block';
                event.preventDefault();
            }
        });
    </script>
@endsection
