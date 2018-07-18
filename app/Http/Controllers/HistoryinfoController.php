<?php

namespace App\Http\Controllers;

use App\Historyinfo;

use Illuminate\Http\Request;
use App\Cart;
use App\Items;
use App\Userorderlocations;
use App\User;
use App\favorites;
use App\ItemImages;

class HistoryinfoController extends Controller
{
    public function __construct()
    {
        $this->itemArray = [];
        $this->items = new Items();
        $this->favorites = new favorites();
        $this->cart = new Cart();
        $this->historyinfo = new Historyinfo();
        $this->itemimages = new itemimages();
    }

    //

    public function getCustomerHistory(Request $request)
    {

        $this->validate($request, [
            'user_id' => 'required',
        ]);
        $items = [];
        $self = $this;
        $user_id = $request->user_id;
        $customerHistory = Historyinfo::where('user_id', $user_id)->with([
            'cart.items' => function ($query) {

            },
            'cart.items.itemimages'])->get();
//        return $customerHistory;

//        $cart = [];
//        $index = 0;
//        foreach ($customerHistory as $cartItem) {
//            if (sizeof($cartItem ['cart']) != 0) {
//                if ($lang == 'ar') {
//
//                    $cartItem ['cart'][$index]['items'] ['item_name'] = $cartItem ['cart'][$index]['items'] ['item_name'];
//                    $cartItem ['cart'][$index]['items'] ['itemdetails_ar'] = $cartItem ['cart'][$index]['items'] ['itemdetails_ar'];
//                    $cartItem ['cart'][$index]['items'] ['messure_unit_ar'] = $cartItem['cart'][$index]['items']['messure_unit_ar'];
//                    array_push($cart, $cartItem);
//                    $index = $index + 1;
//                } else {
//
//                    $cartItem ['cart'][$index]['items'] ['item_name'] = $cartItem ['cart'][$index]['items'] ['item_nameen'];
//                    $cartItem ['cart'][$index]['items'] ['itemdetails_ar'] = $cartItem ['cart'][$index]['items'] ['itemdetails_en'];
//                    $cartItem ['cart'][$index]['items'] ['messure_unit_ar'] = $cartItem['cart'][$index]['items']['messure_unit_en'];
////
//                    array_push($cart, $cartItem);
//                    $index = $index + 1;
//                }
//            } else {
////    return $customerHistory;
////    $index=$index+1;
//            }
//        }
        return  response()->json($customerHistory);
    }

}
