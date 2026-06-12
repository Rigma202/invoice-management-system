$(document).ready(function () {

    $('#productEditForm').submit(function (e) {

        e.preventDefault();

        $('.text-danger').text('');

        let productId = $('#product_id').val();

        $.ajax({
            url: '/products/' + productId,
            type: 'PUT',
            data: {
                name: $('#name').val(),
                price: $('#price').val(),
                description: $('#description').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },

            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                }).then(() => {

                    window.location.href = '/products';

                });

            },

            error: function (xhr) {

                $('.text-danger').text('');

                if (xhr.status === 422) {

                    let errors = xhr.responseJSON.errors;

                    Object.keys(errors).forEach(function (field) {

                        $('#' + field + '_error')
                            .text(errors[field][0]);

                    });

                }

            }

        });

    });

});
