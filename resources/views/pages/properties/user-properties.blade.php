@extends('layouts.app')
@section('title', $title)

@section('content')
<div class="container">
    <h2>Anunțuri postate de {{ $user->name }}</h2>

    <div class="properties-list">
        @foreach ($properties as $property)
            <div class="property-item">
                <a href="{{ route('property.show', ['id' => $property->id]) }}">
                    <img src="{{ asset('img/properties/' . $property->id . '/' . $property->image) }}" alt="{{ $property->title }}">
                    <h3>{{ $property->title }}</h3>
                    <p>{{ $property->location }}</p>
                    <p>{{ $property->price }} EUR</p>
                </a>
            </div>
        @endforeach
    </div>

    {{ $properties->links() }} <!-- Pagination links -->
</div>
@endsection
