<li><a href="{{ route('welcome') }}">Acasă</a></li>
<li><a href="{{ route('properties') }}">Proprietăți</a></li>
<li><a href="#">De vânzare</a>
    <ul>
        <li><a href="#">Apartamente</a></li>
        <li><a href="#">Garsoniere</a></li>
        <li><a href="#">Case și vile</a></li>
        <li><a href="#">Terenuri</a></li>
        <li><a href="#">Spații comerciale</a></li>
    </ul>
</li>
<li><a href="#">De închiriat</a>
    <ul>
        <li><a href="#">Apartamente</a></li>
        <li><a href="#">Garsoniere</a></li>
        <li><a href="#">Case și vile</a></li>
        <li><a href="#">Terenuri</a></li>
        <li><a href="#">Spații comerciale</a></li>
        <li><a href="#">Birouri</a></li>
    </ul>
</li>
<li><a href="{{ route('contact') }}">Contact</a></li>
<li class="d-none d-xl-none d-block d-lg-block"><a href="{{ route('login') }}">Intră în cont</a></li>
<li class="d-none d-xl-none d-block d-lg-block"><a href="{{ route('register') }}">Cont nou</a></li>
<li class="d-none d-xl-none d-block d-lg-block mt-5 pb-4 ml-5 border-bottom-0"><a href="{{ route('properties.create') }}" class="button border btn-lg btn-block text-center">Adaugă proprietate<i class="fas fa-laptop-house ml-2"></i></a></li>
