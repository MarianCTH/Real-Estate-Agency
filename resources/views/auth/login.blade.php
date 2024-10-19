
    @extends('layouts.app')
    @section('title', 'Autentificare')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @section('content')

    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Autentificare</h1>
                <h2><a href="index.html">Acasă </a> &nbsp;/&nbsp; Autentificare</h2>
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
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Rămâi conectat') }}</span>
                            </label>
                        </div>
                    </div>

                    <div class="float-right mt-1"><a id="forgot" href="{{url('forgot-password')}}">Ai uitat parola?</a></div>
                </div>
                <x-primary-button class="btn_1 rounded full-width">
                    {{ __('Autentificare') }}
                </x-primary-button>
                <div class="text-center add_top_10">Nu ai cont încă? <strong><a href="{{route('register')}}">Înregistrare!</a></strong></div>
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

