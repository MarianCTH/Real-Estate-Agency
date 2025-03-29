@extends('layouts.userpanel')
@section('title', $title)


@section('content')
<div class="my-properties">
    @if($properties->count() > 0)
    <table class="table-responsive">
        <thead>
            <tr>
                <th class="pl-2">Proprietate</th>
                <th class="p-0"></th>
                <th>Data Adăugării</th>
                <th>Vizualizări</th>
                <th>Preț</th>

                <th>Acțiuni</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
            <tr>
                <td class="image myelist">
                    <a href="{{ route('property.show', $property->id) }}"><img alt="property-image" src="{{ asset('img/properties/'. $property->id . '/' . $property->image) }}" class="img-fluid"></a>
                </td>
                <td>
                    <div class="inner">
                        <a href="{{ route('property.show', $property->id) }}"><h2>{{ $property->title }}</h2></a>
                        <figure><i class="lni lni-map-marker"></i> {{ $property->location }}</figure>

                    </div>
                </td>
                <td>{{ $property->created_at->format('m.d.Y') }}</td>
                <td>{{ $property->views }}</td>
                <td>{{ rtrim(rtrim(number_format($property->price, 2, ',', '.'), '0'), ',') }}€</td>

                <td class="actions">
                    <a href="{{ route('property.edit', $property->id) }}" class="edit"><i class="lni lni-pencil"></i> Modifică</a>

                    <!-- Delete form -->
                    <form action="{{ route('property.destroy', $property->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-link p-0"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>


            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination-container">
        {{ $properties->links() }}
    </div>
    @else
        <h3>Anunțurile mele</h3>
        <p>Nu ai publicat nici un anunț.</p>
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
