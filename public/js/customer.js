$(document).ready(function () {

    $('#customerForm').submit(function (e) {

        e.preventDefault();
        $('.text-danger').text('');
        $.ajax({

            url: "/customers",
            type: "POST",

            data: {
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                address: $('#address').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function (response) {

                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Customer created successfully'
                }).then(() => {
                    window.location.href = "/customers";
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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong'
                    });

                }
            }

        });

    });

});
