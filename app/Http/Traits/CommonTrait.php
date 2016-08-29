<?php
namespace App;
namespace App\Http\Traits;
use App\Order;
use App\OrderDetail;

trait CommonTrait {
  
    /**
     * Save the order from the makePayment function
     *
     *  */
    public function saveOrder($cart, $payment_id) {   
        
        foreach($cart['category_list'] as $key => $category){
            $order = new Order;
            $order->payment_id = $payment_id;
            $order->category = $category['category'];
            $order->package_type = $category['category_type'];
            $order->price = $cart['original_package_price'][$key];
            $order->discount_price = $cart['package_discount'][$key];
            $order->save();
            /* ---------------START Save the data into the orderdetail table regarding the package order ------- */
            foreach($cart['category_detail_list'][$key] as $product){
                $orderDetail = new OrderDetail;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_sku = $product['sku'];
                $orderDetail->product = $product['product'];
                $orderDetail->quantity = $product['count'];
                $orderDetail->unit_price = $product['original_price'];
                $orderDetail->discount_price = $product['discount_price'];
                $orderDetail->save();   
                unset($orderDetail);
            }
            unset($order);
            /* -------------- END ------------- */
        }        
    }
	
  
}