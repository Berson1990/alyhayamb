<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetails;
use App\Cart;
use DB;

class OrderController extends Controller
{
    //
    public function __construct()
    {
        $this->order = new Order();
        $this->order_details = new OrderDetails();
        $this->cart = new Cart();
    }

    public function StoreOrder()
    {

        $input = Request()->all();

        $order = $this->order->create($input);
        $order_id = $order->order_id;
        $get_product = $this->cart
            ->where('user_id', $input['user_id'])
            ->where('state', 'current')
            ->get();

        foreach ($get_product as $Product) {
            $item_id = $Product->item_id;
            $qty = $Product->quantity;
            $cart_id = $Product->cart_id;
            $this->order_details->create([
                'order_id' => $order_id,
                'item_id' => $item_id,
                'qty' => $qty
            ]);

            $this->cart->find($cart_id)->update(['state' => 'complete']);
        }

        return $this->order
            ->withCount('OrderDeatails')
            ->with('OrderDeatails.Items')
            ->where('order_id', $order_id)
            ->get();

    }

    public function OrderHistory($id)
    {

        return $this->order
            ->withCount('OrderDeatails')
            ->with(['OrderDeatails' => function ($Query) {
                $Query
                    ->with(['Items' => function ($query) {
                        $query->with('itemimages');
                    }]);
            }, 'Users', 'Location'])
            ->where($this->order->getTable() . '.user_id', '=', $id)
            ->get();

    }
}
