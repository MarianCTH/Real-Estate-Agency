@extends('layouts.app')
@section('title', 'Înregistrare')

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

@section('content')

<section class="headings">
    <div class="text-heading text-center">
        <div class="container">
            <h1>Înregistrare</h1>
            <h2><a href="{{ route('welcome') }}">Acasă </a> &nbsp;/&nbsp; Înregistrare</h2>
        </div>
    </div>
</section>

<div id="login">
    <div class="login">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <x-input-label for="type" :value="__('Tip utilizator')" />
                <select id="type" class="form-control" style="height: calc(1.5em + .75rem + 5px);" name="type">
                    <option value="Persoană fizică" {{ old('type') == 'Persoană fizică' ? 'selected' : '' }}>Persoană fizică</option>
                    <option value="Agent imobiliar" {{ old('type') == 'Agent imobiliar' ? 'selected' : '' }}>Agent imobiliar</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div id="juridical-fields" style="display: none;">
                <div class="form-group">
                    <x-input-label for="company_name" :value="__('Nume companie')" />
                    <x-text-input id="company_name" class="form-control" type="text" name="company_name" :value="old('company_name')" />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                </div>

                <div class="form-group">
                    <x-input-label for="cui" :value="__('CUI')" />
                    <x-text-input id="cui" class="form-control" type="text" name="cui" :value="old('cui')" />
                    <x-input-error :messages="$errors->get('cui')" class="mt-2" />
                </div>

                <div class="form-group">
                    <x-input-label for="company_address" :value="__('Adresă companie')" />
                    <x-text-input id="company_address" class="form-control" type="text" name="company_address" :value="old('company_address')" />
                    <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                </div>
            </div>

            <div class="form-group">
                <x-input-label for="name" :value="__('Nume')" />
                <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="password" :value="__('Parolă')" />
                <x-text-input id="password" class="form-control" type="password" name="password" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirmă parola')" />
                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="fl-wrap filter-tags clearfix add_bottom_30">
                <div class="checkboxes float-left">
                    <div class="filter-tags-wrap">
                        <input id="check-b" type="checkbox" name="check">
                        <label for="check-b">Sunt de acord cu <strong><a href="{{ route('confidentiality.policy') }}">termenii și condițiile</a></strong></label>
                    </div>
                </div>
            </div>

            <div id="pass-info" class="clearfix"></div>

            <x-primary-button id="register-btn" class="btn_1 rounded full-width add_top_30" disabled>
                {{ __('Creează cont') }}
            </x-primary-button>

            <div class="text-center add_top_10">Ai deja un cont? <strong><a href="{{ route('login') }}">Autentificare</a></strong></div>
        </form>
    </div>
</div>

<script src="js/jquery-3.5.1.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const typeSelect = document.getElementById("type");
        const juridicalFields = document.getElementById("juridical-fields");
        const termsCheckbox = document.getElementById("check-b");
        const registerButton = document.getElementById("register-btn");

        typeSelect.addEventListener("change", function () {
            if (typeSelect.value === "Agent imobiliar") {
                juridicalFields.style.display = "block";
            } else {
                juridicalFields.style.display = "none";
            }
        });

        termsCheckbox.addEventListener("change", function () {
            registerButton.disabled = !termsCheckbox.checked;
        });
    });
</script>

@endsection
