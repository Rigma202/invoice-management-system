$(document).ready(function () {

    $('.select2').select2({
        placeholder: "Select option",
        width: '100%'
    });

    function calculateTotal() {
        let price = parseFloat($('#product_id option:selected').data('price')) || 0;
        let qty   = parseInt($('#quantity').val()) || 1;
        $('#unit_price').val(price.toFixed(2));
        $('#total_amount').val((price * qty).toFixed(2));
    }

    calculateTotal();

    $('#product_id').on('change', function () {
        calculateTotal();
    });

    $('#quantity').on('input', function () {
        calculateTotal();
    });

    $('#invoiceForm').submit(function (e) {
        e.preventDefault();

        $('.text-danger').text('');

        $.ajax({
            url: $('#invoiceForm').attr('action'),
            type: 'POST',
            data: {
                _method:      'PUT',
                _token:       $('meta[name="csrf-token"]').attr('content'),
                customer_id:  $('#customer_id').val(),
                product_id:   $('#product_id').val(),
                invoice_date: $('#invoice_date').val(),
                due_date:     $('#due_date').val(),
                quantity:     $('#quantity').val(),
                status:       $('#status').val()
            },

            headers: {
                'Accept': 'application/json'
            },

            success: function (response) {
                Swal.fire('Success', response.message, 'success')
                    .then(() => {
                        window.location.href = '/invoices';
                    });
            },

            error: function (xhr) {
                if (xhr.status === 422) {

                    if (xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            $('#' + field + '_error').text(messages[0]);
                        });

                    } else {
                        Swal.fire({
                            icon:  'error',
                            title: 'Stock Error',
                            text:  xhr.responseJSON.message
                        });
                    }

                }
            }

        });
    });

});
