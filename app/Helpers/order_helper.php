<?php 
    use Illuminate\Support\Str;
    use App\Models\Products;
    use App\Models\Carts;
    use Carbon\Carbon;
    use App\Models\Orders;
    use App\Models\User;
    use App\Models\OrderProducts;
    use App\Models\Categorie;
    
    if (!function_exists('update_order_number')) {
        function update_order_number($order_id)
        {
            $data = array(
                'order_number' => $order_id + 10000
            );
            DB::table('orders')
            ->where('id', $order_id)
            ->update($data);
        }
    }

    if (!function_exists('get_user_last_order_date')) {
        function get_user_last_order_date($user_id){
            $order = Orders::where("buyer_id",$user_id)->latest()->first();
            if($order){
                return $order->updated_at;
            }else{
                return '';
            }
        }
    }

    if (!function_exists('get_product_category_by_order_id')){
        function get_product_category_by_order_id($order_id){
            // $orders = Orders::find($order_id);
            $order_products_id = OrderProducts::where('order_id',$order_id)->value('product_id');
            $category_id = Products::where('id',$order_products_id)->value('category_id');
            return $category_id;
        }
    }

    if (!function_exists('get_products_by_order_id')){
        function get_products_by_order_id($order_id, $type=null){
            // $orders = Orders::find($order_id);
            $order_products_id = OrderProducts::where('order_id',$order_id)->value('product_id');
            if($type != null){
                $product = Products::where('id',$order_products_id)->first();
            }else{
                $product = Products::where('id',$order_products_id)->value('title');
            }
            
            return $product;
        }
    }

    if (!function_exists('get_product_category_name_by_order_id')){
        function get_product_category_name_by_order_id($order_id){
            // $orders = Orders::find($order_id);
            $order_products_id = OrderProducts::where('order_id',$order_id)->value('product_id');
            $category_id = Products::where('id',$order_products_id)->value('category_id');
            $category = Categorie::find($category_id);
            if($category){
                return $category->name;
            }else{
                return "";
            }
        }
    }

    if (!function_exists('get_order_by_order_id')){
        function get_order_by_order_id($order_id){
            $order = Orders::find($order_id);
            if($order){
                return $order;
            }else{
                return null;
            }
        }
    }

