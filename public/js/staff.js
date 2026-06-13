$('#staffCreateForm').submit(function (e) {

    e.preventDefault();
    $('#name_error').text('');
    $('#email_error').text('');

    $.ajax({
        url: '/staff',
        type: 'POST',
        data: $(this).serialize(),

        success: function (response) {

            Swal.fire(
                'Success',
                response.message,
                'success'
            ).then(() => {
                location.reload();
            });

        },

        error: function (xhr) {

            let errors = xhr.responseJSON.errors;

            if (errors.name) {
                $('#name_error').text(errors.name[0]);
            }

            if (errors.email) {
                $('#email_error').text(errors.email[0]);
            }
        }
    });
});
$('#staffEditForm').submit(function (e) {

    e.preventDefault();

    let id = $('#edit_staff_id').val();
    $('#edit_name_error').text('');
    $('#edit_email_error').text('');

    $.ajax({
        url: '/staff/' + id,
        type: 'POST',
        data: $(this).serialize(),

        success: function (response) {

            Swal.fire(
                'Success',
                response.message,
                'success'
            ).then(() => {
                location.reload();
            });

        },

        error: function (xhr) {

            let errors = xhr.responseJSON.errors;

            if (errors.name) {
                $('#edit_name_error').text(errors.name[0]);
            }

            if (errors.email) {
                $('#edit_email_error').text(errors.email[0]);
            }
        }
    });
});
