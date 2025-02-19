
    @extends('layouts.app')
    @section('title', 'Autentificare')

    @section('includes')
<link href="https://fonts.googleapis.com/css?family=Lato:300,300i,400,400i%7CMontserrat:600,800" rel="stylesheet">
<!-- FONT AWESOME -->
<link rel="stylesheet" href="css/fontawesome-all.min.css">
<link rel="stylesheet" href="css/fontawesome-5-all.min.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- ARCHIVES CSS -->
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/menu.css">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" id="color" href="css/default.css">
@endsection

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @section('content')

    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Autentificare</h1>
                <h2><a href="{{ route('welcome') }}">Acasă </a> &nbsp;/&nbsp; Autentificare</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION LOGIN -->
    <div id="login">
        <div class="login">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="access_social">
                    <a href="#0" class="social_bt facebook">Autentificare cu Facebook</a>
                    <a href="#0" class="social_bt google">Autentificare cu Google</a>
                </div>
                <div class="divider"><span>Sau</span></div>
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <i class="icon_mail_alt"></i>
                </div>
                <div class="form-group">
                    <x-input-label for="password" :value="__('Parolă')" />

                    <x-text-input id="password" class="form-control"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <i class="icon_lock_alt"></i>
                </div>
                <div class="fl-wrap filter-tags clearfix add_bottom_30">
                    <div class="checkboxes float-left">
                        <div class="filter-tags-wrap">
                            <input id="check-b" type="checkbox" name="check">
                            <label for="check-b">Rămâi conectat</label>
                        </div>
                    </div>
                    <div class="float-right mt-1"><a id="forgot" href="{{url('forgot-password')}}">Ai uitat parola?</a></div>
                </div>
                <x-primary-button class="btn_1 rounded full-width">
                    {{ __('Autentificare') }}
                </x-primary-button>
                <div class="text-center add_top_10">Nu ai cont încă? <strong><a href="{{route('register')}}">Înregistrare</a></strong></div>
                <x-input-error :messages="$errors->get('email')" class="error" />

            </form>
        </div>
    </div>
    <!-- END SECTION LOGIN -->

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mmenu.min.js"></script>
    <script src="js/mmenu.js"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script src="js/ajaxchimp.min.js"></script>
    <script src="js/newsletter.js"></script>
    <script src="js/color-switcher.js"></script>
    <script src="js/inner.js"></script>
    @endsection

