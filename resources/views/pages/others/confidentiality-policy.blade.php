@extends('layouts.app')
@section('title', 'Politica de confidențialitate')

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
                <h1>Politica de confidențialitate</h1>
                <h2><a href="{{ route('welcome') }}">Acasă </a> &nbsp;/&nbsp; Politica de confidențialitate</h2>
            </div>
        </div>
    </section>

    <section class="faq service-details bg-white">
        <div class="container">
            <h3 class="mb-5">Politica de confidențialitate
            </h3>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <ul class="accordion accordion-1 one-open">
                        <li class="active">
                            <div class="title">
                                <span>Introducere</span>
                            </div>
                            <div class="content">
                                <p>
                                    Comisia Europeană este dedicată principiului respectării și protejării dreptului
                                    dumneavoastră la viață privată. Comisia Europeană colectează și prelucrează date cu
                                    caracter personal în temeiul Regulamentului (UE) 2018/1725 al Parlamentului European și
                                    al Consiliului din 23 octombrie 2018 privind protecția persoanelor fizice în ceea ce
                                    privește prelucrarea datelor cu caracter personal de către instituțiile, organele,
                                    oficiile și agențiile Uniunii și privind libera circulație a acestor date [și de
                                    abrogare a Regulamentului (CE) nr. 45/2001].

                                    Prezenta declarație de confidențialitate explică de ce vă prelucrăm datele personale,
                                    cum colectăm, procesăm și protejăm toate datele personale furnizate, cum utilizăm
                                    informațiile și ce drepturi aveți în raport cu datele dumneavoastră cu caracter
                                    personal. De asemenea, conține datele de contact ale operatorului de date responsabil pe
                                    care puteți să-l contactați pentru a vă exercita drepturile, pe cele ale responsabilului
                                    cu protecția datelor și ale Autorității Europene pentru Protecția Datelor.

                                    Prezenta declarație de confidențialitate se referă la operațiunea de prelucrare a
                                    datelor cu caracter personal de către Comisia Europeană atunci când tratează cererile
                                    inițiale și de confirmare privind accesul la documente depuse în temeiul Regulamentului
                                    (CE) nr. 1049/2001. Operațiunea este întreprinsă de unitatea „Transparență, gestionarea
                                    documentelor și accesul la documente” din cadrul Secretariatului General (operator de
                                    date instituțional în numele Comisiei Europene) și de unitățile responsabile cu tratarea
                                    cererilor inițiale de acces la documente din departamentul sau serviciul competent al
                                    Comisiei (operatorul de date de facto în numele Comisiei Europene).
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>De ce și cum vă prelucrăm datele cu caracter personal?
                                </span>
                            </div>
                            <div class="content">
                                <p>
                                    Comisia Europeană colectează și utilizează datele dumneavoastră cu caracter personal
                                    pentru a trata cererile de acces la documente depuse în temeiul Regulamentului (CE) nr.
                                    1049/2001 în termenele prevăzute și pentru a întocmi un raport statistic anual, în
                                    conformitate cu cerințele articolului 17 alineatul (1) din acest regulament. În plus,
                                    anumite operațiuni de prelucrare a datelor personale conținute în documentele care
                                    urmează să fie divulgate sunt necesare pentru a permite accesul public la un registru de
                                    documente, după cum prevede articolul 11 din regulamentul de mai sus. Datele personale
                                    pot fi prelucrate și în contextul unei anchete desfășurate de Ombudsmanul European sau
                                    de Curtea de Conturi a Uniunii Europene sau al unor proceduri judiciare ale Curții de
                                    Justiție a UE.

                                    Datele dumneavoastră cu caracter personal nu vor fi utilizate pentru un proces
                                    decizional automatizat, nici pentru crearea de profiluri.

                                    Puteți depune cereri de acces la documentele Comisiei Europene în două moduri.
                                    Prelucrarea datelor dumneavoastră cu caracter personal se va face diferit, în funcție de
                                    modul ales.

                                    2.1. Depunerea cererilor prin intermediul portalului online

                                    Portalul Comisiei Europene „Solicitați acces la un document al Comisiei” (denumit în
                                    continuare „portalul”) vă permite să depuneți cereri de acces la documentele Comisiei
                                    Europene în temeiul Regulamentului (CE) nr. 1049/2001.

                                    Pentru a depune o cerere prin intermediul acestui portal, aveți nevoie de un cont „EU
                                    Login” (serviciu de autentificare pentru o gamă largă de servicii și sisteme informatice
                                    ale Comisiei Europene).

                                    Dacă aveți deja un cont EU Login, vă puteți conecta cu acreditările existente. Dacă nu
                                    aveți cont EU Login, vi se va cere să vă creați unul când faceți clic pe butonul
                                    „Trimiteți o cerere” sau „Creați un cont” de pe pagina de pornire a portalului.

                                    La crearea contului EU Login, va trebui să vă introduceți numele, prenumele și adresa de
                                    e-mail. Ulterior, vă puteți gestiona datele „nume” și „prenume” din contul EU Login.
                                    Pentru mai multe informații, vă rugăm să consultați declarația specifică de
                                    confidențialitate referitoare la EU Login și la operațiunea de prelucrare „Serviciul de
                                    gestionare a identităților și accesului (IAMS)” (referința de înregistrare în registrul
                                    public al RPD: DPR-EC-03187).

                                    Când vă conectați pentru prima dată la portal utilizând contul dumneavoastră EU Login,
                                    portalul creează automat un cont asociat (denumit în continuare „cont de acces la
                                    documente”). Contul de acces la documente reutilizează numele, prenumele și adresa de
                                    e-mail din contul EU Login, dar vă permite să adăugați și să gestionați date cu caracter
                                    personal suplimentare, cum ar fi profilul, numărul de telefon, adresa poștală, țara,
                                    reprezentantul legal și organizația dumneavoastră. Veți putea gestiona aceste date prin
                                    intermediul spațiului de gestionare a contului de acces la documente – pentru a accesa
                                    acest spațiu, faceți clic pe butonul „Conectat” din partea de sus a oricărei pagini a
                                    portalului.

                                    Modificările efectuate în contul EU Login în ceea ce privește numele și prenumele sunt
                                    reflectate automat în contul de acces la documente.

                                    2.1.1. Depunerea cererilor inițiale prin intermediul portalului

                                    Atunci când depuneți prima cerere inițială prin intermediul portalului, pe lângă nume,
                                    prenume și adresă de e-mail (date asociate contului EU Login), trebuie să indicați țara
                                    de reședință, cu excepția cazului în care ați introdus deja această informație în contul
                                    dumneavoastră de acces la documente. Acest lucru este necesar întrucât, în temeiul
                                    Regulamentului (UE) 2018/1725 privind protecția datelor, se aplică seturi diferite de
                                    obligații dacă datele cu caracter personal conținute în documentul solicitat sunt
                                    transferate unui solicitant dintr-o țară UE/SEE sau unuia din afara UE/SEE. Puteți
                                    modifica oricând această informație în spațiul de gestionare a contului de acces la
                                    documente de pe portal.

                                    Când depuneți cererea prin intermediul portalului, nu este necesar să furnizați o adresă
                                    poștală, întrucât Comisia vă va trimite răspunsul său pe cale electronică, prin
                                    intermediul portalului (îl veți găsi în rubrica „Răspunsul la cererea inițială”), cu
                                    toate garanțiile legale necesare în ceea ce privește data notificării răspunsului.

                                    Adresa poștală este obligatorie dacă solicitați în mod explicit să primiți răspunsul la
                                    cererea inițială nu numai pe cale electronică, prin intermediul portalului, ci și prin
                                    poștă (și anume pe suport de hârtie).

                                    2.1.2. Depunerea cererilor de confirmare legate de cererile inițiale depuse prin
                                    intermediul portalului online

                                    Puteți solicita o revizuire a răspunsului Comisiei la cererea inițială prin depunerea
                                    unei cereri de confirmare pentru accesul la documente, în conformitate cu articolul 7
                                    alineatul (2) din Regulamentul (CE) nr. 1049/2001.

                                    Pentru cererile inițiale depuse prin intermediul portalului, puteți face acest lucru
                                    fie:

                                    a) prin intermediul butonului „Solicitați o reexaminare” de pe pagina cererii de pe
                                    portal;

                                    b) prin e-mail sau poștă. Adresa de e-mail și adresa poștală la care puteți trimite o
                                    cerere de confirmare sunt indicate în răspunsul Comisiei la cererea inițială.

                                    În ambele cazuri, nu este necesar să indicați adresa dumneavoastră poștală, întrucât
                                    Comisia trimite răspunsul la cererea de confirmare pe cale electronică, prin intermediul
                                    portalului (la rubrica „Răspunsul la cererea de confirmare”), cu toate garanțiile legale
                                    necesare în ceea ce privește data notificării răspunsului.

                                    Dacă solicitați explicit să primiți răspunsul la cererea de confirmare nu numai pe cale
                                    electronică, prin intermediul portalului, ci și prin poștă (adică pe suport de hârtie),
                                    trebuie să vă indicați adresa poștală – în caz contrar, răspunsul va fi trimis doar
                                    electronic.

                                    Dacă precizați explicit că nu doriți să primiți răspunsul la cererea de confirmare prin
                                    intermediul portalului, ci numai prin alte mijloace, este obligatoriu să furnizați
                                    adresa poștală de destinație. Comisia nu va începe să trateze cererea de confirmare până
                                    când nu primește adresa la care trebuie să trimită răspunsul.

                                    2.2. Depunerea cererii prin e-mail sau poștă

                                    Dacă depuneți cererea prin e-mail sau poștă, trebuie să vă indicați numele, prenumele,
                                    adresa de e-mail (numai pentru cererile trimise prin e-mail) și adresa poștală. Dacă nu
                                    vă indicați adresa poștală, Comisia nu va începe să vă trateze cererea. Adresa poștală
                                    este obligatorie din mai multe motive:

                                    În primul rând, pentru a obține securitate juridică în ceea ce privește data la care ați
                                    primit răspunsul Comisiei la cererea dumneavoastră, etapă care poate presupune
                                    trimiterea răspunsului prin poștă sau prin alte mijloace care oferă garanțiile juridice
                                    necesare în ceea ce privește data notificării răspunsului.
                                    În al doilea rând, pentru a ști dacă aveți reședința în UE/SEE și, în caz contrar, în ce
                                    țară terță aveți reședința, astfel încât normele de protecție a datelor să fie aplicate
                                    în mod corect tuturor datelor cu caracter personal care ar putea apărea în documentele
                                    la care solicitați acces. Regulamentul (UE) 2018/1725 privind protecția datelor prevede
                                    norme diferite în funcție de reședința destinatarului datelor cu caracter personal (în
                                    UE/SEE sau în altă parte). Întrucât marea majoritate a documentelor solicitate conțin
                                    date cu caracter personal, Comisia Europeană nu poate garanta aplicarea corectă a
                                    normelor privind protecția datelor dacă nu vă cunoaște adresa poștală;
                                    În al treilea rând, pentru a aplica în mod corect Regulamentul (CE) nr. 1049/2001.
                                    Articolul 4 alineatul (1) litera (b) din respectivul regulament se referă la protecția
                                    vieții private și a integrității individului și trebuie aplicat în conformitate cu
                                    Regulamentul privind protecția datelor;
                                    Pentru cererile transmise în acest mod, Comisia va trimite răspunsul la cererile
                                    inițiale într-un mod care să garanteze securitatea juridică în ceea ce privește data
                                    notificării răspunsului (de exemplu, prin poștă).

                                    Dacă ați depus cererea prin e-mail sau poștă, puteți depune cererea de confirmare, în
                                    conformitate cu articolul 7 alineatul (2) din Regulamentul (CE) nr. 1049/2001, prin
                                    e-mail sau poștă. Adresa de e-mail și adresa poștală la care puteți trimite cererea de
                                    confirmare sunt indicate în răspunsul Comisiei la cererea inițială.

                                    Comisia va trimite răspunsul la cererile de confirmare într-un mod care să garanteze
                                    securitatea juridică în ceea ce privește data notificării răspunsului (de exemplu, prin
                                    poștă).
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Pe ce temei juridic ne bazăm când vă prelucrăm datele personale?</span>
                            </div>
                            <div class="content">
                                <p>
                                    Comisia Europeană prelucrează datele dumneavoastră cu caracter personal pentru că:

                                    prelucrarea este necesară pentru îndeplinirea unei sarcini de interes public [articolul
                                    5 alineatul (1) litera (a) din Regulamentul (UE) 2018/1725]; și pentru că
                                    prelucrarea este necesară în vederea îndeplinirii obligației legale care îi revine
                                    Comisiei Europene [articolul 5 alineatul (1) litera (b) din Regulamentul (UE)
                                    2018/1725].
                                    În plus, prelucrarea datelor cu caracter personal neobligatorii pe care le furnizați în
                                    cererea dumneavoastră de acces la documente (a se vedea secțiunea 4 de mai jos) sau pe
                                    portal se bazează pe consimțământul dumneavoastră [conform articolului 5 alineatul (1)
                                    litera (d) din Regulamentul (UE) 2018/1725].

                                    Prelucrarea efectuată în temeiul articolului 5 alineatul (1) literele (a) și (b) trebuie
                                    să se bazeze pe dreptul Uniunii, și anume pe articolul 15 alineatul (3) din Tratatul
                                    privind funcționarea Uniunii Europene și pe Regulamentul (CE) nr. 1049/2001.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Ce date colectăm și prelucrăm?</span>
                            </div>
                            <div class="content">
                                <p>
                                    Datele cu caracter personal colectate și apoi prelucrate sunt:

                                    a) Datele cu caracter personal furnizate când depuneți cererea:

                                    i. Date cu caracter personal obligatorii:

                                    - nume și prenume

                                    - adresa de e-mail (pentru cererile depuse prin portal sau e-mail)

                                    - țara de reședință (pentru cererile depuse prin intermediul portalului, a se vedea
                                    punctul 2.1.)

                                    - adresa poștală (pentru cererile depuse prin e-mail sau poștă, a se vedea punctul 2.2.)

                                    ii. Date cu caracter personal opționale: a) numărul de telefon, adresa poștală (numai
                                    pentru cererile depuse prin intermediul portalului, a se vedea punctul 2.1.),
                                    organizația, reprezentantul legal, profilul solicitantului.

                                    b) datele cu caracter personal ale solicitantului și ale altor persoane incluse în
                                    cerere și în orice altă corespondență schimbată între solicitant și Comisie (răspuns la
                                    cerere, scrisoare de prelungire a termenului, cerere de clarificare etc.)

                                    c) datele cu caracter personal conținute în documentele solicitate, dacă acestea sunt
                                    puse la dispoziție în temeiul Regulamentului (CE) nr. 1049/2001

                                    (d) datele de contact ale reprezentanților terților, în cazul consultării unor părți
                                    terțe

                                    e) dacă există îndoieli întemeiate cu privire la identitatea persoanei fizice care
                                    formulează solicitarea, Comisia Europeană îi poate cere solicitantului să furnizeze o
                                    copie a documentului de identitate (de exemplu, un pașaport sau o carte de identitate)
                                    pentru a-i verifica identitatea, în următoarele circumstanțe excepționale:

                                    atunci când documentele vizate de cerere conțin date cu caracter personal ale
                                    solicitantului, iar solicitantului i se acordă accesul individual la astfel de
                                    documente;
                                    atunci când există motive legitime să se considere că dreptul de acces care decurge din
                                    Regulamentul (CE) nr. 1049/2001 este utilizat în mod abuziv de către respectivul
                                    solicitant.
                                    Documentul de identificare ar trebui să conțină numele solicitantului și, dacă este
                                    cazul, adresa sa poștală, iar orice alte date, cum ar fi o fotografie sau orice alte
                                    caracteristici personale, pot fi ocultate.
                                </p>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <span>Cum vă protejăm datele cu caracter personal?</span>
                            </div>
                            <div class="content">
                                <p>
                                    Toate datele în format electronic (e-mailuri, documente, seturi de date încărcate etc.)
                                    sunt stocate fie pe serverele Comisiei Europene, fie pe cele ale contractanților săi.
                                    Operațiunile acestora respectă Decizia (UE, Euratom) 2017/46 a Comisiei din 10 ianuarie
                                    2017 privind securitatea sistemelor informatice și de comunicații în cadrul Comisiei
                                    Europene.

                                    Contractanții Comisiei Europene au obligația de a respecta o clauză contractuală
                                    specifică pentru orice operațiune de prelucrare a datelor dumneavoastră personale
                                    efectuată în numele Comisiei Europene. Aceștia trebuie, de asemenea, să respecte
                                    obligațiile de confidențialitate care decurg din măsurile de transpunere a
                                    Regulamentului general privind protecția datelor în statele membre ale UE.

                                    Pentru a vă proteja datele cu caracter personal, Comisia Europeană a instituit o serie
                                    de măsuri tehnice și organizatorice. Măsurile tehnice includ acțiuni adecvate pentru a
                                    garanta securitatea online, pentru a evita riscul pierderii datelor, modificarea datelor
                                    sau accesul neautorizat, luând în considerare riscul prezentat de prelucrarea datelor și
                                    natura datelor personale prelucrate. Măsurile organizatorice includ acordarea accesului
                                    la datele cu caracter personal doar persoanelor autorizate care au un interes legitim să
                                    le cunoască în contextul acestei operațiuni de prelucrare.
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
