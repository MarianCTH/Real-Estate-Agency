@extends('layouts.userpanel')
@section('title', $title)

@section('content')

    <h1>{{ $title }}</h1>

    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nume Societate</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="cui">CUI</label>
            <input type="text" name="cui" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Adresă</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="mobile_phone">Telefon</label>
            <input type="text" name="mobile_phone" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="image">Imagine</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="image-gallery">
            @foreach($images as $image)
            <div class="image-item" data-image-id="{{ $image->id }}">
                <img src="{{ asset('img/properties/' . $image->filename) }}" alt="Property Image">
                <button class="btn btn-primary set-main" data-id="{{ $image->id }}">Set as Main</button>
                <button class="btn btn-danger delete-image" data-id="{{ $image->id }}">Delete</button>
            </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Creează Societatea</button>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.set-main').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                // AJAX request to set the main image
                fetch(`/properties/set-main/${imageId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert('Main image set successfully!');
                      }
                  });
            });
        });

        document.querySelectorAll('.delete-image').forEach(button => {
            button.addEventListener('click', function() {
                const imageId = this.getAttribute('data-id');
                // AJAX request to delete the image
                fetch(`/properties/delete-image/${imageId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          alert('Image deleted successfully!');
                          // Optionally remove the image from the DOM
                          this.closest('.image-item').remove();
                      }
                  });
            });
        });
    });
    </script>
@endsection

<style>
.image-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.image-item {
    position: relative;
    width: 150px;
    height: 150px;
    overflow: hidden;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.image-item img {
    width: 100%;
    height: auto;
}

.image-item button {
    position: absolute;
    bottom: 5px;
    left: 5px;
    right: 5px;
    margin: 0 auto;
    display: block;
    width: calc(100% - 10px);
}
</style>
