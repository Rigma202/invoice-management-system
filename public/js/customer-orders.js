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

    let button = $(this);
    let id = button.data('id');

    Swal.fire({
        title: 'Reject Order?',
        text: 'Are you sure you want to reject this order?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Reject'
    }).then((result) => {

        if (!result.isConfirmed) {
            return;
        }

        $.ajax({
            url: '/orders/' + id + '/reject',
            type: 'PATCH',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },

            success: function (response) {

                Swal.fire({
                    icon: 'info',
                    title: 'Order Rejected',
                    text: response.message
                }).then(() => {
                    location.reload();
                });

            }
        });

    });

});
