<?php

namespace App;

use Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Model;
use App\Items;
use App\Cart;

class ItemImages extends Model
{
    //
    protected $table = 'itemimages';
    protected $primaryKey = 'itemimages_id';

    public function items()
    {
        return $this->hasMany('App\items', 'item_id');

    }

    public function cart()
    {
        return $this->hasMany('App\Cart', 'item_id');

    }

    public function storeItemImage($itemId, $imageEncoded)
    {

        $itemImage = new ItemImages;
        // $itemImage->itemimages_id=$itemId;
        $image = $imageEncoded;

        $Id = time();

        $realbath = '/var/www/html/bakery/bBakery/public';
        $filename = $Id . '.' . 'jpg';
        $location = $realbath . '/ItemImages/' . $filename;

        Image::make($image)->resize(500, 350)->save($location);
        $itemImage->image_path = $filename;
        $itemImage->item_id = $itemId;
        $itemImage->save();

    }

}
