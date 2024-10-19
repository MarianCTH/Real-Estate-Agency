@extends('layouts.app')
@section('title', 'Contact')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<section class="headings">
    <div class="text-heading text-center">
        <div class="container">
            <h1>Contact</h1>
            <h2><a href="index.html">Acasă </a> &nbsp;/&nbsp; Contact</h2>
        </div>
    </div>
</section>
<!-- END SECTION HEADINGS -->

<!-- START SECTION CONTACT US -->
<section class="contact-us">
    <div class="container">
        <div class="property-location mb-5">
            <h3>Locația noastră</h3>
            <div class="divider-fade"></div>
            <div id="map-contact" class="contact-map"></div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <h3 class="mb-4">Contactează-ne</h3>
                <form id="contactform" class="contact-form" method="post" action="{{ route('contact.store') }}" novalidate>
                    @csrf
                    <div id="success" class="successform" style="display: none;">
                        <p class="alert alert-success font-weight-bold" role="alert">Your message was sent successfully!</p>
                    </div>
                    <div id="error" class="errorform" style="display: none;">
                        <p>Something went wrong, try refreshing and submitting the form again.</p>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="text" required class="form-control input-custom input-full" name="name" placeholder="Prenume">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="text" required class="form-control input-custom input-full" name="lastname" placeholder="Nume">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <input type="text" class="form-control input-custom input-full" name="email" placeholder="Email">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <textarea class="form-control textarea-custom input-full" id="ccomment" name="message" required rows="8" placeholder="Mesaj"></textarea>
                    </div>
                    <button type="submit" id="submit-contact" class="btn btn-primary btn-lg">Trimite</button>
                </form>
            </div>
            <div class="col-lg-4 col-md-12 bgc">
                <div class="call-info">
                    <h3>Detalii de contact</h3>
                    <p class="mb-5">Găsiți mai jos datele de contact și programul de lucru.</p>
                    <ul>
                        <li>
                            <div class="info">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p class="in-p">Strada Alexandru Odobescu, Bistrița 420020</p>
                            </div>
                        </li>
                        <li>
                            <div class="info">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <p class="in-p">+40 751 460 249</p>
                            </div>
                        </li>
                        <li>
                            <div class="info">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <p class="in-p ti">office@imobiliarebn.ro</p>
                            </div>
                        </li>
                        <li>
                            <div class="info cll">
                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <p class="in-p ti">8:00 a.m - 16:00 p.m</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END SECTION CONTACT US -->
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mmenu.min.js"></script>
<script src="js/mmenu.js"></script>
<script src="js/jquery.form.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/smooth-scroll.min.js"></script>
<script src="js/forms.js"></script>
<script src="js/ajaxchimp.min.js"></script>
<script src="js/newsletter.js"></script>
<script src="js/leaflet.js"></script>
<script src="js/leaflet-gesture-handling.min.js"></script>
<script src="js/leaflet-providers.js"></script>
<script src="js/leaflet.markercluster.js"></script>
<script src="js/map-single.js"></script>
<script src="js/color-switcher.js"></script>
<script src="js/inner.js"></script>
<script>
    $(document).ready(function() {
        $('#contactform').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    $('#success').show();
                    $('#error').hide();
                    $('#contactform')[0].reset(); // Reset the form fields
                },
                error: function(xhr) {
                    $('#error').show();
                    $('#success').hide();
                }
            });
        });
    });
    </script>
@endsection
