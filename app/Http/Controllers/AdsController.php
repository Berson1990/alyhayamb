<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ads;
use App\Items;
use App\ItemImages;
use App\categories;
use App\SubCategory;

class AdsController extends Controller
{
    //
    public function __construct()
    {
        $this->ads = new Ads();
        $this->item = new Items();
        $this->item_images = new ItemImages();
        $this->categories = new categories();
        $this->sub_category = new SubCategory();
    }

    public function Slider()
    {
        return $this->ads
            ->with(['item' => function ($query) {
                $query->with(['itemimages', 'category' => function ($Category)
                {
                    $Category->with('SubCtegroy');

                },'favorites', 'cart']);
            }])
            ->where($this->ads->getTable() . '.state', '=', 1)
            ->groupBy($this->ads->getTable() . '.ads_id')
            ->get();

    }

    public function Offer()
    {
        return $this->ads
            ->with(['item' => function ($query) {
                $query->with(['itemimages', 'category' => function ($Category)
                {
                    $Category->with('SubCtegroy');

                },'favorites', 'cart']);
            }])
            ->where($this->ads->getTable() . '.state', '=', 2)
            ->groupBy($this->ads->getTable() . '.ads_id')
            ->get();

    }
}
