$('.select2').select2({
    placeholder: "Select option",
    width: '100%'
});

$('#invoiceForm').submit(function(e){

    e.preventDefault();

    // clear previous errors
    $('.text-danger').text('');

    $.ajax({

        url: '/invoices',
        type: 'POST',
        data: {
            customer_id: $('#customer_id').val(),
            product_id: $('#product_id').val(),
            invoice_date: $('#invoice_date').val(),
            due_date: $('#due_date').val(),
            quantity: $('#quantity').val()
        },

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json'
        },

        success: function(response){

            Swal.fire(
                'Success',
                response.message,
                'success'
            ).then(() => {
                window.location.href = '/invoices';
            });

        },

        error: function(xhr) {

            if (xhr.status === 422) {

                if (xhr.responseJSON.errors) {

                    let errors = xhr.responseJSON.errors;

                    $.each(errors, function(field, messages) {
                        $('#' + field + '_error').text(messages[0]);
                    });

                } else {

                    Swal.fire({
                        icon: 'error',
                        title: 'Stock Error',
                        text: xhr.responseJSON.message
                    });

                }
            }
        }

    });

});
$(document).ready(function () {

    function calculateTotal() {

        let price = parseFloat($('#product_id option:selected').data('price')) || 0;
        let qty = parseInt($('#quantity').val()) || 1;

        let total = price * qty;

        $('#unit_price').val(price.toFixed(2));
        $('#total_amount').val(total.toFixed(2));
    }

    $('#product_id').on('change', function () {

        let price = parseFloat($('#product_id option:selected').data('price')) || 0;
        $('#unit_price').val(price.toFixed(2));
        calculateTotal();
    });

    $('#quantity').on('input', function () {
        calculateTotal();
    });
    $('#quantity').val(1);
    calculateTotal();

});

    $(document).ready(function () {

        $('#invoiceTable').DataTable();

        $('.delete-form').on('submit', function(e){

            e.preventDefault();

            let form = this;

            let invoiceId = $(this).data('invoice-id');

            Swal.fire({
                title: 'Delete Invoice?',
                text: 'Are you sure you want to delete Invoice #' + invoiceId + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {

                if(result.isConfirmed){
                    form.submit();
                }

            });

        });

    });
$('.view-invoice').click(function () {

    let invoiceId = $(this).data('id');

    $.ajax({
        url: '/invoices/' + invoiceId,
        type: 'GET',

        success: function(response) {

            $('#invoiceDetails').html(response);

            let modal = new bootstrap.Modal(
                document.getElementById('invoiceModal')
            );

            modal.show();
        },

        error: function() {

            Swal.fire(
                'Error',
                'Unable to load invoice details',
                'error'
            );

        }
    });

});
