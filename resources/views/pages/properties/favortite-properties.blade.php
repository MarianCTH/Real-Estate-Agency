@extends('layouts.userpanel')
@section('title', $title)


@section('content')
<div class="my-properties">
    @if($favorites->count() > 0)
    <table class="table-responsive">
        <thead>
            <tr>
                <th class="pl-2">Proprietate</th>
                <th class="p-0"></th>
                <th>Data postării</th>
                <th>Preț</th>

                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($favorites as $property)
            <tr>
                <td class="image">
                    <a href="{{ route('property.show', $property->id) }}"><img alt="{{ $property->title }}" src="{{ asset('img/properties/'. $property->id . '/' . $property->image) }}" class="img-fluid"></a>
                </td>
                <td>
                    <div class="inner">
                        <a href="{{ route('property.show', $property->id) }}"><h2>{{ $property->title }}</h2></a>
                        <figure><i class="lni-map-marker"></i> {{ $property->location }}</figure>
                    </div>
                </td>
                <td>{{ $property->created_at->format('m.d.Y') }}</td>
                <td>{{ rtrim(rtrim(number_format($property->price, 2, ',', '.'), '0'), ',') }}€</td>
                <td>
                <form action="{{ route('favorites.destroy', $property->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link" style="padding: 0; border: none; background: none;">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination-container">
        {{ $favorites->links() }}
    </div>
    @else
        <h3>Anunțuri favorite</h3>
        <p>Nu ai nici un anunț adăugat la favorite.</p>
    @endif
</div>


@endsection

@section('includes-js')
<script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/tether.min.js') }}"></script>
<script src="{{ asset('js/moment.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/mmenu.min.js') }}"></script>
<script src="{{ asset('js/mmenu.js') }}"></script>
<script src="{{ asset('js/swiper.min.js') }}"></script>
<script src="{{ asset('js/swiper.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>
<script src="{{ asset('js/slick2.js') }}"></script>
<script src="{{ asset('js/fitvids.js') }}"></script>
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('js/lightcase.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/newsletter.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/searched.js') }}"></script>
<script src="{{ asset('js/dashbord-mobile-menu.js') }}"></script>
<script src="{{ asset('js/forms-2.js') }}"></script>
<script src="{{ asset('js/color-switcher.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/leaflet.js') }}"></script>
<script src="{{ asset('js/leaflet-gesture-handling.min.js') }}"></script>
<script src="{{ asset('js/leaflet-providers.js') }}"></script>
<script src="{{ asset('js/leaflet.markercluster.js') }}"></script>
<script src="{{ asset('js/leaflet.snogylop.js') }}"></script>
@endsection
