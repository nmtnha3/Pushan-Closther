
    $(document).ready(function() {
        var initialTotalPrice = parseFloat($("#totalPrice").val().replace('₫', '').replace(',', ''));

        $('input[name="discount"]').change(function() {
            var discountPercentage = $(this).val();

            var discountedPrice = (initialTotalPrice * discountPercentage) / 100;
            var finalPrice = initialTotalPrice - discountedPrice;

            $("#totalPrice").val(finalPrice.toLocaleString());
            $("#tempDiscount").html(discountedPrice + '₫');
        });
    });
