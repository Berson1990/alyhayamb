<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Items;
use App\Userorderlocations;
use Illuminate\Http\Request;
use App\User;
use App\TartCart;
use App\TartAdds;
use App\favorites;
use App\ItemImages;
use App\Historyinfo;
use App\TartOption;
use App\TartSize;
use App\TartFloors;
use App\TartAddional;
use App\TartColorHandler;
use Image;

class CartController extends Controller
{
    public function __construct()
    {
        $this->users = new User();
        $this->items = new Items();
        $this->tartcart = new tartCart();
        $this->current = 'current';
        $this->tartadds = new TartAdds();
        $this->favorites = new favorites();
        $this->cart = new Cart();
        $this->historyinfo = new Historyinfo();
        $this->itemimages = new itemimages();
        $this->tartoptions = new TartOption();
        $this->tartFloor = new TartFloors();
        $this->tart_size = new TartSize();
        $this->tartAddional = new TartAddional();
        $this->tartcolorhandler = new TartColorHandler();
    }

    public function GetTartOptions($id)
    {
        return $this->tartoptions->with('TartFloor', 'TartSize')
            ->where($this->tartoptions->getTable() . '.item_id', $id)
            ->get();
    }

    public function AddtoCart()
    {
        $input = Request()->all();
        $check = $this->cart
            ->where('item_id', $input['item_id'])
            ->where('user_id', $input['user_id'])
            ->where('state' ,'current')
            ->get();

        if (sizeof($check) > 0) {
            return ['state' => false];
        } else {
            $cart = $this->cart->create($input);
            $cart_id = $cart->cart_id;
            if ($input['tart'] == true) {

                $image = $input["tart_image"];
                $jpg_name = "photo-" . time() . ".jpg";
                $realbath = '/var/www/html/bakery/bBakery/public';
                $path = $realbath . "/tartImages/" . $jpg_name;
                $input["tart_image"] = "tartImages/" . $jpg_name;
                $input['cart_id'] = $cart_id;
                $img = substr($image, strpos($image, ",") + 1);//take string after ,
                $imgdata = base64_decode($img);
                $success = file_put_contents($path, $imgdata);
                $tartcart = $this->tartcart->create($input);
                $tart_cart_id = $tartcart->tart_cart_id;
                for ($c = 0; $c < sizeof($input['tartcolor']); $c++) {
                    $input['tartcolor'][$c]['tart_cart_id'] = $tart_cart_id;
                    $this->tartcolorhandler->create($input['tartcolor'][$c]);
                }
                for ($a = 0; $a < sizeof($input['tartaddional']); $a++) {
                    $input['tartaddional'][$a]['cart_tart_id'] = $tart_cart_id;
                    $this->tartAddional->create($input['tartaddional'][$a]);
                }
            }
            return ['state' => true];
        }

    }

    public function getCart($user_id)
    {
        return $this->cart
            ->with('items.itemimages')
            ->where($this->cart->getTable() . '.user_id', $user_id)
            ->where($this->cart->getTable() . '.state', 'current')
            ->get();
    }

    public function IncreseQTY($cart_id, $typeof)
    {
        $oldquantity = $this->cart->where('cart_id', $cart_id)->get();
        $oldquantity = $oldquantity[0]['quantity'];
        global $newQuantity;
        if ($typeof == 'plus') {
             $newQuantity = $oldquantity + 1;
        } else if ($typeof == 'subtract') {
             $newQuantity = $oldquantity - 1;
        }
        $this->cart->where($this->cart->getTable() . '.cart_id', '=', $cart_id)->update(['quantity' => $newQuantity]);
        return ["state" => true];
    }

    public function DeleteFromCart($cart_id)
    {

        $this->cart->where('cart_id', $cart_id)->delete();
        return ['state' => true];
    }

}
