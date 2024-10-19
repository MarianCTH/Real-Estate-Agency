@extends('layouts.app')
@section('title', 'Politica de cookie-uri')

@section('includes')
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="css/fontawesome-all.min.css">
    <link rel="stylesheet" href="css/fontawesome-5-all.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

@endsection
@section('body-class', 'inner-pages ui-elements hd-white')
@section('content')
    <section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Politica de cookie-uri</h1>
                <h2><a href="{{ route('welcome') }}">Acasă </a> &nbsp;/&nbsp; Politica de cookie-uri</h2>
            </div>
        </div>
    </section>

    <section class="faq service-details bg-white">
        <div class="container">
            <h3 class="mb-5">Politica de cookie-uri</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <ul class="accordion accordion-1 one-open">
                        <li class="active">
                            <div class="title">
                                <span>Confidențialitatea dvs.</span>
                            </div>
                            <div class="content">
                                <p>
                                    Când vizitați orice site web, acesta poate stoca sau prelua informații pe browserul
                                    dvs., mai ales sub formă de cookie-uri. Aceste informații ar putea fi despre dvs.,
                                    preferințele dvs. sau la dispozitivul dvs. și sunt utilizate în principal pentru ca
                                    site-ul să funcționeze așa cum este de așteptat. De obicei, informațiile nu vă
                                    identifică direct, dar vă pot oferi o experiență web mai personalizată. Deoarece vă
                                    respectăm dreptul la confidențialitate, puteți alege să nu permiteți anumite tipuri de
                                    cookie-uri. Faceți clic pe titlurile diverselor categorii pentru informații suplimentare
                                    și pentru a schimba setările noastre implicite. Cu toate acestea, blocarea anumitor
                                    tipuri de fișiere cookie vă poate influența experiența pe site și serviciile pe care vi
                                    le putem oferi.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Cookie-uri strict necesare
                                </span>
                            </div>
                            <div class="content">
                                <p>
                                    Aceste tipuri de cookie-uri sunt necesare pentru paginile de internet să funcționeze în
                                    mod corespunzător. Modulele cookie strict necesare vă permit să navigați prin site și să
                                    beneficiați de caracteristicile sale. Fără aceste module cookie, nu vom putea oferi
                                    anumite caracteristici, cum ar fi redirecționarea automată la cel mai puțin ocupat
                                    server sau reținerea listei dvs. de preferințe.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Cookie-uri de performanță și analiză</span>
                            </div>
                            <div class="content">
                                <p>
                                    Aceste tipuri de cookies oferă posibilitatea operatorilor site-urilor de internet să
                                    monitorizeze vizitele şi sursele de trafic, modul în care utilizatorii interacționează
                                    cu pagina de internet sau anumite secțiuni din pagina de internet. Informațiile
                                    furnizate de modulele cookie de analiză ajută operatorii să înțeleagă cum folosesc
                                    vizitatorii site-urile şi apoi să folosească această informație pentru a îmbunatăți
                                    modul în care este prezentat conținutul oferit utilizatorilor.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Cookie-uri de targetare şi publicitate</span>
                            </div>
                            <div class="content">
                                <p>
                                    Aceste cookie-uri pot oferi posibilitatea de a monitoriza activitățile online ale
                                    utilizatorilor și de a stabili profiluri de utilizatori, care pot fi apoi folosite în
                                    scopuri de marketing. Spre exemplu, pe baza cookie-urilor pot fi identificate produsele
                                    și serviciile agreate de către un utilizator, aceste informații servind ulterior la
                                    transmiterea de mesaje publicitare adecvate către respectivul utilizator.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Cookie-uri funcționale</span>
                            </div>
                            <div class="content">
                                <p>
                                    Modulele cookie funcționale înregistrează informații legate de alegerile pe care
                                    utilizatorii le fac și permit, de asemenea, operatorilor de site-uri să personalizeze
                                    site-ul conform cerințelor utilizatorului. De exemplu, modulele cookies pot fi utilizate
                                    pentru a salva preferințele legate de categorie/segment.
                                </p>
                            </div>
                        </li>
                    </ul>
                    <!--end of accordion-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.min.js') }}"></script>
    <script src="{{ asset('js/mmenu.js') }}"></script>
    <script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
    <script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('js/newsletter.js') }}"></script>
    <script src="{{ asset('js/color-switcher.js') }}"></script>
    <script src="{{ asset('js/inner.js') }}"></script>

    <script>
        $(".accordion li").click(function() {
            $(this).closest(".accordion").hasClass("one-open") ? ($(this).closest(".accordion").find("li")
                    .removeClass("active"), $(this).addClass("active")) : $(this).toggleClass("active"),
                "undefined" != typeof window.mr_parallax && setTimeout(mr_parallax.windowLoad, 500)
        });
    </script>
@endsection
