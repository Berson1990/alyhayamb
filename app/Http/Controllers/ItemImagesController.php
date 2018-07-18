<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
class ItemImagesController extends Controller
{
    //
    public function __construct()
    {
        $this->items=new Items();
//        $this->favorites=new favorites();
//        $this->cart=new Cart();
//        $this->itemimages=new itemimages();
    }
}
