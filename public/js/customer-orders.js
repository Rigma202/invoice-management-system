$(document).on('click', '.acceptOrder', function () {

    let button = $(this);
    let id = button.data('id');

    $.ajax({
        url: '/orders/' + id + '/accept-order',
        type: 'PATCH',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function (response) {

            Swal.fire({
                icon: 'success',
                title: 'Congratulations!',
                text: response.message
            }).then(() => {
                location.reload();
            });

        }
    });

});

$(document).on('click', '.rejectOrder', function () {

    $('#reject_order_id').val($(this).data('id'));
    $('#rejection_reason').val('');
    $('#rejectModal').modal('show');
});


$('#submitReject').click(function () {

    let id = $('#reject_order_id').val();

    $.ajax({
        url: '/orders/' + id + '/reject',
        type: 'PATCH',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            rejection_reason: $('#rejection_reason').val()
        },

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

            if(errors.rejection_reason){
                $('#rejection_reason_error')
                    .text(errors.rejection_reason[0]);
            }
        }
    });

});
