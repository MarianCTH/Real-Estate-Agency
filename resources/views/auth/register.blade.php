
@extends('layouts.app')
@section('title', 'Înregistrare')

@section('content')

<section class="headings">
    <div class="text-heading text-center">
        <div class="container">
            <h1>Register</h1>
            <h2><a href="index.html">Home </a> &nbsp;/&nbsp; Register</h2>
        </div>
    </div>
</section>
<!-- END SECTION HEADINGS -->

<!-- START SECTION 404 -->
<div id="login">
    <div class="login">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <x-input-label for="name" :value="__('Nume')" />
                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="password" :value="__('Parolă')" />

                <x-text-input id="password" class="form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="form-group" style="margin-bottom: 15px !important">
                <x-input-label for="password_confirmation" :value="__('Confirmă parola')" />

                <x-text-input id="password_confirmation" class="form-control"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <p>În momentul în care apeși pe “Creează cont”, accepți <strong><a href="#">Termenii și condițiile</a></strong> Imobiliare Bistrita</p>
            <p>Am înțeles că S.C. Imobiliare Bistrita îmi folosește datele personale în conformitate cu <strong><a href="{{ route('confidentiality.policy') }}">Declarația de confidențialitate</a></strong> și <strong><a href="{{ route('cookie.policy') }}">Politica privind modulele cookie și alte tehnologii similare</a></strong>.</p>
            <div id="pass-info" class="clearfix"></div>
            <x-primary-button class="btn_1 rounded full-width add_top_30">
                {{ __('Creează cont') }}
            </x-primary-button>
            <div class="text-center add_top_10">Ai deja un cont? <strong><a href="{{ route('login') }}">Autentificare</a></strong></div>
        </form>
    </div>
</div>
<!-- END SECTION 404 -->

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
