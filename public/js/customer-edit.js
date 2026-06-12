$(document).ready(function () {

    $('#customerEditForm').submit(function (e) {

        e.preventDefault();
        $('.text-danger').text('');
        let customerId = $('#customer_id').val();
        $.ajax({
            url: '/customers/' + customerId,
            type: 'PUT',
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
                    text: response.message || 'Customer updated successfully'
                }).then(() => {

                    window.location.href = '/customers';

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


    $('#customerTable').DataTable();
    $('.delete-form').on('submit', function (e) {

        e.preventDefault();

        let form = this;
        let customerName = $(this).data('customer-name');

        Swal.fire({
            title: 'Delete Customer?',
            text: 'Are you sure you want to delete "' + customerName + '"?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});


