@extends('layouts.userpanel')
@section('title', $title)

@section('content')
    <div class="single-add-property">
        <h3>{{ $title }}</h3>
        <div class="property-form-group">
            <form action="{{ route('password.update') }}" method="POST" id="password-form">
                @csrf
                @method('PUT')

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

                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="current_password">Parola curentă</label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   placeholder="Introduceți parola curentă">
                        </p>
                        @error('current_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="new_password">Parola nouă</label>
                            <input type="password" 
                                   name="new_password" 
                                   id="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   placeholder="Introduceți parola nouă">
                        </p>
                        @error('new_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p>
                            <label for="confirm_new_password">Confirmă parola nouă</label>
                            <input type="password" 
                                   name="confirm_new_password" 
                                   id="confirm_new_password"
                                   class="form-control @error('confirm_new_password') is-invalid @enderror" 
                                   placeholder="Confirmați parola nouă">
                        </p>
                        @error('confirm_new_password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div id="validation-message" class="alert alert-danger mt-2" style="display: none;"></div>

                <div class="prperty-submit-button">
                    <button type="submit" class="btn btn-primary btn-lg">Schimbă parola</button>
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
        document.getElementById('password-form').addEventListener('submit', function(event) {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmNewPassword = document.getElementById('confirm_new_password').value;
            var validationMessageDiv = document.getElementById('validation-message');
            var hasError = false;

            validationMessageDiv.style.display = 'none';
            validationMessageDiv.textContent = '';

            if (!currentPassword || !newPassword || !confirmNewPassword) {
                validationMessageDiv.textContent = 'Vă rugăm să completați toate câmpurile obligatorii.';
                hasError = true;
            } else if (newPassword.length < 8) {
                validationMessageDiv.textContent = 'Parola nouă trebuie să conțină cel puțin 8 caractere.';
                hasError = true;
            } else if (newPassword !== confirmNewPassword) {
                validationMessageDiv.textContent = 'Parolele noi introduse nu corespund.';
                hasError = true;
            } else if (currentPassword === newPassword) {
                validationMessageDiv.textContent = 'Parola nouă trebuie să fie diferită de parola curentă.';
                hasError = true;
            }

            if (hasError) {
                validationMessageDiv.style.display = 'block';
                event.preventDefault();
            }
        });
    </script>
@endsection
