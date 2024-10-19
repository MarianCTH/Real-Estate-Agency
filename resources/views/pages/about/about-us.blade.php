@extends('layouts.app')
@section('title', 'Despre noi')

@section('content')
<section class="headings">
    <div class="text-heading text-center">
        <div class="container">
            <h1>Despre compania noastră</h1>
            <h2><a href="index.html">Acasă </a> &nbsp;/&nbsp; Despre noi</h2>
        </div>
    </div>
</section>
<!-- END SECTION HEADINGS -->

<!-- START SECTION ABOUT -->
<section class="about-us fh">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 who-1">
                <div>
                    <h2 class="text-left mb-4">Despre <span>Direkt imobiliare</span></h2>
                </div>
                <div class="pftext">
                    <p>In calitate de agenti si brokeri imobiliari oferim clientilor nostrii un serviciu complet .
                        Decizia de a cumpara sau a vinde o proprietate este luata de obicei o data in viata . Unii cauta rapid si usor cea mai atractiva oferta , ceilalti vor sa gaseasca un client si sa obtina cel mai bun pret posibil. </p>

                    <p>Cu toate acestea , cu totii cauta furnizorul de servicii care ii va insoti in mod optim atunci cand cumpara sau vand o proprietate .
                        Beneficiem de multi ani de experienta in domeniul afacerilor imobiliare , motiv pentru care va economisim mult timp in calitate de client-un bun care poate fi masurat si in bani .</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="wprt-image-video w50">
                    <img alt="image" src="img/bg/bg-video.jpg">
                    <a class="icon-wrap popup-video popup-youtube" href="https://www.youtube.com/watch?v=Mh41Sk2iKEw">
                        <i class="fa fa-play"></i>
                    </a>
                    <div class="iq-waves">
                        <div class="waves wave-1"></div>
                        <div class="waves wave-2"></div>
                        <div class="waves wave-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION ABOUT -->

<!-- START SECTION WHY CHOOSE US -->
<section class="how-it-works bg-white-2">
    <div class="container">
        <div class="sec-title">
            <h2><span>De ce </span>să ne alegeți?</h2>
            <p>De ce Direkt Imobiliare ? raspunsul este simplu : pentru cel mai bun rezultat. Noi suntem cei mai rapizi in vânzarea proprietatii tale.</p>
        </div>
        <div class="row service-1">
            <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="fade-up">
                <div class="serv-flex">
                    <div class="art-1 img-13">
                        <img src="images/icons/icon-4.svg" alt="">
                        <h3>Brokeraj imobiliar</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">O clientela complexa si parteneriatele noastre garanteaza cel mai bun rezultat. Personalul nostru competent va fi incantat sa va sfatuiasca cu privire la toate intrebarile astfel incat sa puteti gestiona vanzarea proprietatii dumneavoastre . Organizam toate procesele in vederea vanzarii proprietatii dvs, de ex de la o opinie de expert la un concept de marketing. </p>
                    </div>
                </div>
            </article>
            <article class="col-lg-4 col-md-6 col-xs-12 serv" data-aos="fade-up">
                <div class="serv-flex">
                    <div class="art-1 img-14">
                        <img src="images/icons/icon-5.svg" alt="">
                        <h3>Profesionalism</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">Beneficiati de serviciile noastre , suntem fericiti sa avem grija de preocuparile dumneavoastra .: design interior , echipa pt renovat , foto profesionale , video proprietate, asigurari locuinte.
                            Ne-ar face placere sa va sunam inapoi si sa stabilim o programare in vederea evaluarii pentru proprietarea dumnevoastra , acest serviciu este gratuit .</p>
                    </div>
                </div>
            </article>
            <article class="col-lg-4 col-md-6 col-xs-12 serv mb-0 pt" data-aos="fade-up">
                <div class="serv-flex arrow">
                    <div class="art-1 img-15">
                        <img src="images/icons/icon-6.svg" alt="">
                        <h3>Finanțare ușoară</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">Ne ocupam profesional de toate discutiile cu bancile , va ajutam in obtinerea celei mai bune finantari , contractam negocieri cu notarii. Consultanti nostri isi folosesc profesionalismul si experienta pentru a rezolva toate indoielile pe care le ati putea avea atunci cand cumparati o proprietate in Romania .</p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
<!-- END SECTION WHY CHOOSE US -->

<!-- START SECTION COUNTER UP -->
<section class="counterup">
    <div class="container">
        @include('partials.counter')
    </div>
</section>
<!-- END SECTION COUNTER UP -->

<section class="team">
    <div class="container">
        <div class="sec-title">
            <h2><span>Echipa</span>noastră</h2>
            <p>Oferim servicii complete la fiecare pas.</p>
        </div>
        @include('partials.team')
    </div>
</section>

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/moment.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mmenu.min.js"></script>
<script src="js/mmenu.js"></script>
<script src="js/aos.js"></script>
<script src="js/aos2.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/slick3.js"></script>
<script src="js/fitvids.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.counterup.min.js"></script>
<script src="js/imagesloaded.pkgd.min.js"></script>
<script src="js/isotope.pkgd.min.js"></script>
<script src="js/smooth-scroll.min.js"></script>
<script src="js/lightcase.js"></script>
<script src="js/owl.carousel.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/ajaxchimp.min.js"></script>
<script src="js/newsletter.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/forms-2.js"></script>
<script src="js/leaflet.js"></script>
<script src="js/leaflet-gesture-handling.min.js"></script>
<script src="js/leaflet-providers.js"></script>
<script src="js/leaflet.markercluster.js"></script>
<script src="js/map4.js"></script>
<script src="js/color-switcher.js"></script>
<script src="js/inner.js"></script>
<script src="js/searched.js"></script>
<script src="js/popup.js"></script>
<script src="js/light.js"></script>

<script src="revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="revolution/js/jquery.themepunch.revolution.min.js"></script>

<script src="js/script.js"></script>
@endsection
