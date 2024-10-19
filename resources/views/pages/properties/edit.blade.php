@extends('layouts.app')

@section('content')
<h1>Edit Property</h1>

<form action="{{ route('property.update', $property->id) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $property->title }}">
    </div>
    <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" name="location" value="{{ $property->location }}">
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" class="form-control" id="price" name="price" value="{{ $property->price }}">
    </div>

    <button type="submit" class="btn btn-primary">Update Property</button>
</form>
@endsection
