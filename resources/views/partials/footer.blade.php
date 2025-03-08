<footer class="first-footer">
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="netabout">
                        <a href="{{ url('/') }}" class="logo">
                            <img src="{{ asset('img/logo-footer.png') }}" alt="netcom">
                        </a>
                        <p>Partenerul dvs. competent in domeniul imobiliar.</p>
                    </div>
                    <div class="contactus">
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
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="navigation">
                        <h3>Navigare</h3>
                        <div class="nav-footer">
                            <ul>
                                <li><a href="{{ url('/') }}">Acasă</a></li>
                                <li><a href="{{ url('/properties') }}">Proprietăți</a></li>
                                <li><a href="{{ url('/agents') }}">Agenți</a></li>
                                <li class="no-mgb"><a href="{{ url('/contact') }}">Contact</a></li>
                            </ul>
                            <ul class="nav-right">
                                <li><a href="{{ route('confidentiality.policy') }}">Confidențialitate</a></li>
                                <li><a href="{{ route('cookie.policy') }}">Cookie-uri</a></li>
                                <li><a href="{{ url('/auth') }}">Autentificare</a></li>
                                <li class="no-mgb"><a href="{{ url('/register') }}">Înregistrare</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="widget">
                        <h3>Ultimele listări</h3>
                        <div class="twitter-widget contuct">
                            <div class="twitter-area">
                                @foreach($latestProperties as $property)
                                    <div class="single-item">
                                        <div class="icon-holder">
                                            <i class="fa fa-post" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h5><a href="{{ url('/properties/' . $property->id) }}">{{ $property->title }}</a></h5>
                                            <h4>{{ $property->created_at->diffForHumans() }}</h4>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="newsletters">
                        <h3>Informații</h3>
                        <p>Înscrieți-vă la buletinul nostru informativ pentru a primi cele mai recente actualizări și oferte.</p>
                    </div>
                    <form id="subscribeForm" class="bloq-email mailchimp form-inline" method="post" action="{{ route('subscribe') }}">
                        @csrf
                        <div class="email">
                            <input type="email" id="subscribeEmail" name="EMAIL" placeholder="Introduceți email-ul" required>
                            <input type="submit" value="Înscriere">
                        </div>
                        <label class="success" id="subscriptionSuccess"></label>

                        <label for="subscribeEmail" id="subscriptionError" class="error">
                            @error('EMAIL')
                                {{ $message }}
                            @enderror
                        </label>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="second-footer">
        <div class="container">
            <p>2024 © Copyright <strong><a href="#"> {{ config('app.name') }}</a></strong>. Toate drepturile rezervate.</p>
            <p>
                Website dezvoltat de către <strong><a href="https://web.czrsolutions.ro/">CZRSolutions</a></strong>
            </p>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#subscribeForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: $(this).attr('action'), // Use the form's action URL
                method: 'POST',
                data: $(this).serialize(), // Serialize the form data
                success: function(response) {
                    // Handle a successful response
                    $('#subscriptionSuccess').text(response.success);
                    $('#subscribeEmail').val(''); // Clear the input field
                    $('#subscriptionError').hide();
                },
                error: function(xhr) {
                    // Handle errors
                    if (xhr.status === 400) {
                        // Display the error message for already subscribed email
                        $('#subscriptionSuccess').text('');
                        $('.error').text(xhr.responseJSON.error);
                    } else {
                        // Handle other errors
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function(key, value) {
                            errorMessages += value[0] + ' ';
                        });
                        $('.error').text(errorMessages.trim());
                    }
                }
            });
        });
    });
</script>
