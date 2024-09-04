<script>
    //for calculate total product price
    $('#product_chooseable').on('change', function() {
        var selectedValue = $(this).val();
        // console.log(selectedValue);
        // alert('You selected: ' + selectedValue);
        $.ajax({
            url:"{{ route('get-produc-price') }}",
            type:"GET",
            data:{ product_id: selectedValue },
            success:function(resp){
                // console.log(resp);
                $('#product_price').val(parseFloat(resp));
                calculateTotalPrice();
            }
        });
    });

    $('#category').on('change',function(){
        $.ajax({
            url:"{{ route('monthly-return.get-products-by-category') }}",
            type:'POST',
            data:{"category_id":$(this).val(),"_token":"{{ csrf_token() }}"},
            success:function(response){
                $("#product_chooseable").html('');
                $('#product_price').val('');
                $.each(response, function(index, item) {
                    $("#product_chooseable").append('<option value="' + item.id + '">' + item.title + '</option>');
                });
            }
        });
    });

    function calculateTotalPrice() {
        // var product_price = parseInt(document.getElementById('product_price').value) || 0;
        // var discounted_price = parseInt(document.getElementById('discounted_price').value) || 0;
        // var gst_price = parseInt(document.getElementById('gst_price').value) || 0;
        // var shipping_price = parseInt(document.getElementById('shipping_price').value) || 0;

        // var calculate_total = product_price + gst_price + shipping_price;
        // var totalPrice = calculate_total - discounted_price;

        // document.getElementById('total_price').value = totalPrice;
    }
    // calculateTotalPrice();



    function change_payment_status(order_id,value){
        $.ajax({
            url:"{{ route('orders.update-payment-status') }}",
            type:"POST",
            data:{ order_id: order_id,payment_status:value,_token:'{{csrf_token()}}' },
            success:function(resp){
                // console.log(resp);
                if(resp==1){
                    showToast('success', 'Success', 'Payment Status Updated Successfully');
                }else{
                    showToast('error', 'Error', 'Payment Status Not Updated');
                }
            }
        });
    }

    function change_order_status(order_id,value){
        $.ajax({
            url:"{{ route('orders.update-order-status') }}",
            type:"POST",
            data:{ order_id: order_id,order_status:value,_token:'{{csrf_token()}}' },
            success:function(resp){
                // console.log(resp);
                if(resp==1){
                    location.reload();
                    showToast('success', 'Success', 'Status Updated Successfully');
                }else{
                    showToast('error', 'Error', 'Status Not Updated');
                }
            }
        });
    }
</script>