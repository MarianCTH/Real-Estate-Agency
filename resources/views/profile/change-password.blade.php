@extends('layouts.userpanel')
@section('title', $title)

@section('content')
    <div class="my-address" style="margin-bottom: 11%">
        <h3 class="heading pt-0">{{ $title }}</h3>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group name">
                        <label>Parola curentă</label>
                        <input type="password" name="current_password" class="form-control" placeholder="Parola curentă" required>
                        @if ($errors->has('current_password'))
                            <span class="text-danger">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group email">
                        <label>Parola nouă</label>
                        <input type="password" name="new_password" class="form-control" placeholder="Parola nouă" required>
                        @if ($errors->has('new_password'))
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group subject">
                        <label>Confirmă parola nouă</label>
                        <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirmă parola nouă" required>
                        @if ($errors->has('confirm_new_password'))
                            <span class="text-danger">{{ $errors->first('confirm_new_password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="send-btn mt-2">
                        <button type="submit" class="btn btn-common">Schimbă parola</button>
                    </div>
                </div>
            </div>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
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
    <script>
        document.getElementById('password-form').addEventListener('submit', function(event) {
            var currentPassword = document.getElementById('current_password').value;
            var newPassword = document.getElementById('new_password').value;
            var confirmNewPassword = document.getElementById('confirm_new_password').value;
            var validationMessageDiv = document.getElementById('validation-message');

            // Clear previous validation messages
            validationMessageDiv.textContent = '';

            if (!currentPassword || !newPassword || !confirmNewPassword) {
                validationMessageDiv.textContent = 'Completează toate câmpurile.';
                event.preventDefault(); // Prevent form submission
            } else if (newPassword !== confirmNewPassword) {
                validationMessageDiv.textContent = 'Parolele nu corespund.';
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
@endsection
