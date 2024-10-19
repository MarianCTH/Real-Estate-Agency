<header id="header-container">
    <!-- Header -->
    <div id="header">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('welcome') }}"><img src="{{asset('img/logo.png')}}" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">
                        @include('partials.navlist')
                    </ul>
                </nav>
                <!-- Main Navigation / End -->
            </div>
            <!-- Left Side Content / End -->
            <div class="right-side d-none d-none d-lg-none d-xl-flex">
                <!-- Header Widget -->
                <div class="header-widget">
                    <a href="{{ route('properties.create') }}" class="button border"><i class="fas fa-plus-circle"></i>  Adaugă anunț</a>
                </div>
                <!-- Header Widget / End -->
            </div>
            @guest
            <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                <!-- Header Widget -->

                    <div class="header-widget sign-in">
                        <div class="">
                            <a href="{{ route('login') }}">Autentificare</a>
                        </div>
                    </div>

                <!-- Header Widget / End -->
            </div>
            <div class="right-side d-none d-none d-lg-none d-xl-flex sign ml-0">
                <!-- Header Widget -->

                    <div class="header-widget sign-in">
                        <div class="">
                            <a href="{{ route('register') }}">Înregistrare</a>
                        </div>
                    </div>

                <!-- Header Widget / End -->
            </div>

            @endguest
            @auth

            <div class="header-user-menu user-menu add">
                <div class="header-user-name">
                    <span><img src="{{ asset('img/users/' . auth()->user()->image) }}" alt="User Image">
                    </span>{{ auth()->user()->name }}
                </div>
                <ul>
                    <li><a href="{{ route('profile') }}">Profil</a></li>
                    <li><a href="{{ route('my-properties') }}">Anunțurile mele</a></li>
                    <li><a href="{{ route('favorite-properties') }}">Proprietăți favorite</a></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Log Out
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
            @endauth
        </div>
    </div>
    <!-- Header / End -->

</header>
