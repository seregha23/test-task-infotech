let App = {


    init: function (debug) {
        App.events();
    },

    events: function () {
        $(document).on('submit', '.subscribe-form-js', function (event) {
            event.preventDefault()
            let data = $(this).serialize();
            data += '&_csrf=' + csrfToken;
            let action = $(this).attr('action');
            $.ajax({
                type: 'POST',
                data: data,
                url: action,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (data) {
                    if (data.notification !== undefined) {
                        toastr[data.notification.style](data.notification.message, data.notification.title)
                    }
                    $('.subscribe-form-js')[0].reset();
                }
            })
        })

        $(document).on('click', '.remove-book-js', function() {
            if (!confirm('Вы действительно хотите удалить книгу?')) {
                return false
            }
            let bookId = $(this).data('book_id')
            $.ajax({
                type: 'POST',
                data: {
                    '_csrf': csrfToken,
                    'bookId': bookId,
                },
                url: '/books/ajax-remove-book',
                dataType: 'json',
                success: function (response) {
                }
            })
        })
    },
}