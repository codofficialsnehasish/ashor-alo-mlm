<script>

    function validateInput() {
        var inputField = document.getElementById('quantity');
        var value = inputField.value;
        if (value === '' || value <= 0) {
            inputField.value = 1;
        }
    }
    validateInput();

    function fetchCart(){
        $.ajax({
            url: "{{ route('fetchCartCount') }}",
            type: "get",
            data: '',
            success: function (response) {
                console.log(response);
                // if (response.status == 1) {
                    $('#CartCount').html(response);
                    $('#CartCount1').html(response);
                    // $('#subtol').html(response.cartTotal);
                    // $('#shippingcost').html(response.shipping)
                    // $('#tot').html(response.cartTotal);
                // }
            }
        });
    }

    // ADD TO CART
    // $(document).on("submit", "#add-to-cart-form", function (event) {
    //     var form = $("#add-to-cart-form");
    //     var serializedData = form.serializeArray();
    //     $.ajax({
    //         url: "{{ route('cart.add-to-cart') }}",
    //         type: "post",
    //         data: serializedData,
    //         dataType: "json",
    //         success: function (response) {
    //             // console.log(response);
    //             if(response.status){
    //                 form[0].reset();
    //                 showToast('success', 'Success', response.msg);
    //                 fetchCart();
    //             }else{
    //                 showToast('error', 'Error', response.msg);
    //             }
    //         }
    //     });
    //     event.preventDefault();
    // });

    function add_to_cart(id){
        var form = $("#add-to-cart-form"+id);
        var serializedData = form.serializeArray();
        $.ajax({
            url: "{{ route('cart.add-to-cart') }}",
            type: "post",
            data: serializedData,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if(response.status){
                    form[0].reset();
                    showToast('success', 'Success', response.msg);
                    fetchCart();
                }else{
                    showToast('error', 'Error', response.msg);
                }
            }
        });
        // event.preventDefault();
    }

    $(window).on("load", function() {
        fetchCart();
    });
</script>