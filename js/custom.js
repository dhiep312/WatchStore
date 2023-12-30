 $(document).ready(function () {


    $('.increment-btn').click(function (e) {
        e.preventDefault();

        let qty = $(this).closest('.product_data').find('.input-qty').val();

        let value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10)
        {
            value++;
            $(this).closest('.product_data').find('.input-qty').val(value);
        }
    });
});
