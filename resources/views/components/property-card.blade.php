<div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
    <div class="project-single">
        <div class="project-inner project-head">
            <div class="homes">
                <!-- homes img -->
                <a href="{{ route('property.show', $property->id) }}" class="homes-img">
                    @if($property->featured)
                        <div class="homes-tag button alt featured">Promovat</div>
                    @endif
                    <div class="homes-tag button alt sale">{{ $property->status }}</div>
                    <div class="homes-price">{{ number_format($property->price, 3) }} €</div>
                    <img src="{{ asset('img/properties/' . $property->image) }}" alt="{{ $property->title }}" class="img-responsive">
                </a>
            </div>
            <div class="button-effect">
                <a href="{{ route('property.show', $property->id) }}" class="btn"><i class="fa fa-link"></i></a>
                <!-- Example YouTube video, replace with your own if needed -->
                <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                <a href="#" class="img-poppu btn"><i class="fa fa-photo"></i></a>
            </div>
        </div>
        <!-- homes content -->
        <div class="homes-content">
            <!-- homes address -->
            <h3><a href="{{ route('property.show', $property->id) }}">{{ $property->title }}</a></h3>
            <p class="homes-address mb-3">
                <a href="{{ route('property.show', $property->id) }}">
                    <i class="fa fa-map-marker"></i><span>{{ $property->location }}</span>
                </a>
            </p>
            <!-- homes List -->
            <ul class="homes-list clearfix pb-3">
                <li class="the-icons">
                    <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                    <span>{{ $property->bedrooms }} Dormitoare</span>
                </li>
                <li class="the-icons">
                    <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                    <span>{{ $property->bathrooms }} Băi</span>
                </li>
                <li class="the-icons">
                    <i class="flaticon-square mr-2" aria-hidden="true"></i>
                    <span>{{ $property->size }} m2</span>
                </li>
                <li class="the-icons">
                    <i class="flaticon-car mr-2" aria-hidden="true"></i>
                    <span>{{ $property->garages }} Garaje</span>
                </li>
            </ul>
            <div class="footer">
                <a href="{{ route('pages.agents.show', $property->user->id) }}">
                    <img src="{{ asset('img/users/' . $property->user->image) }}" alt="" class="mr-2"> {{ $property->user->name }}
                </a>
                <span>{{ $property->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>
