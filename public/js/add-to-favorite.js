$(document).on('click', '.favorite-toggle', function () {
    var propertyId = $(this).data('id');
    var el = $(this);

    $.ajax({
        url: '/favorite/' + propertyId,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content') // Get CSRF token from meta tag
        },
        success: function () {
            // Toggle heart color
            el.find('i').toggleClass('red-heart');
        },
        error: function (xhr) {
            console.log(xhr.responseText); // For debugging
        }
    });
});
