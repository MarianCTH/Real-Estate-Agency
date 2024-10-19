<li>
    <a @if($title == 'Panoul de utilizator') class="active" @endif href="{{ route('dash') }}">
        <i class="fa fa-map-marker"></i> Panou de utilizator
    </a>
</li>
<li>
    <a @if($title == 'Profilul meu') class="active" @endif href="{{ route('profile') }}">
        <i class="fa fa-user"></i>Profil
    </a>
</li>
<li>
    <a @if($title == 'Proprietățile mele') class="active" @endif href="{{ route('my-properties') }}">
        <i class="fa fa-list" aria-hidden="true"></i>Anunțurile mele
    </a>
</li>
<li>
    <a @if($title == 'Proprietăți favorite') class="active" @endif href="{{ route('favorite-properties') }}">
        <i class="fa fa-heart" aria-hidden="true"></i>Proprietăți favorite
    </a>
</li>
<li>
    <a @if($title == 'Adaugă anunț') class="active" @endif href="{{ route('properties.create') }}">
        <i class="fa fa-list" aria-hidden="true"></i>Adaugă anunț
    </a>
</li>

<li>
    <a @if($title == 'Schimbă parola') class="active" @endif href="{{ route('profile.change-password') }}">
        <i class="fa fa-lock"></i>Schimbă parola
    </a>
</li>
<li>
    <a href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i>Ieși din cont

    </a>
</li>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
