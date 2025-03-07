<li><a href="{{ route('welcome') }}">Acasă</a></li>
<li><a href="#">Imobiliare</a>
    <ul>
        <li><a href="{{ route('properties') }}">Toate proprietățile</a></li>

        @php
            // Retrieve all the statuses from the PropertyStatus model
            $statuses = \App\Models\PropertyStatus::all();
        @endphp

        @foreach ($statuses as $status)
            <li><a href="{{ route('properties', ['status' => $status->id]) }}">{{ $status->name }}</a>
                <ul>
                    @foreach (\App\Models\PropertyType::all() as $type)
                        <li><a href="{{ route('properties', ['status' => $status->id, 'property_type' => $type->id]) }}">{{ $type->name }}</a></li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</li>



<li><a href="#">Rețea imobiliară</a>
    <ul>
        <li><a href="{{ route('agents') }}">Agenți imobiliari</a></li>

        <li><a href="{{ route('agencies') }}">Societăți imobiliare</a>
    </ul>
</li>
<li><a href="{{ route('contact') }}">Contact</a></li>
<li class="d-none d-xl-none d-block d-lg-block"><a href="{{ route('login') }}">Intră în cont</a></li>
<li class="d-none d-xl-none d-block d-lg-block"><a href="{{ route('register') }}">Cont nou</a></li>
<li class="d-none d-xl-none d-block d-lg-block mt-5 pb-4 ml-5 border-bottom-0"><a href="{{ route('properties.create') }}" class="button border btn-lg btn-block text-center">Adaugă proprietate<i class="fas fa-laptop-house ml-2"></i></a></li>
