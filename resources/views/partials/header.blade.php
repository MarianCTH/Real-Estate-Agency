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

<style>
#header-container {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

#navigation ul li a {
    font-size: 15px;
    font-weight: 500;
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.2s ease;
}

#navigation ul li a:hover {
    color: #3B5998;
}

.button.border {
    white-space: nowrap;
    padding: 8px 15px;
    display: inline-flex;
    align-items: center;
    color: #3B5998;
}

.button.border i {
    font-size: 14px;
    margin-right: 5px;
}

.header-widget.sign-in a {
    font-size: 15px;
    font-weight: 500;
    color: #2c3e50;
    text-decoration: none;
    transition: color 0.2s ease;
}

.header-widget.sign-in a:hover {
    color: #3B5998;
}

.header-user-name {
    font-weight: 500;
    color: #2c3e50;
}

.header-user-menu ul {
    background: white;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.header-user-menu ul li a {
    font-size: 14px;
    color: #2c3e50;
    padding: 10px 20px;
    transition: background-color 0.2s ease;
}

.header-user-menu ul li a:hover {
    background-color: #f8f9fa;
    color: #3B5998;
}

.compare-count {
    background: #e54242;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    margin-left: 5px;
    display: inline-block;
    min-width: 18px;
    text-align: center;
}

.header-widget {
    display: inline-flex;
    align-items: center;
}

.ml-3 {
    margin-left: 1rem;
}
</style>
