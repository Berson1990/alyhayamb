<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Items;
use App\ItemImages;
use App\Cart;

class favorites extends Model
{
//    public function items()
//    {
//        return $this->belongsTo('App\Items', 'item_id');
//    }
    //
    protected $table = 'favorites';
    protected $primaryKey = 'favorite_id';

    public function items()
    {
        return $this->belongsTo('App\Items', 'item_id');
    }

    public function itemimages()
    {
        return $this->belongsTo('App\itemimages', 'item_id');
    }

    public function cart()
    {
        return $this->hasMany('App\Cart', 'item_id');
    }

    public function Category()
    {
        return $this->belongsTo('App\categories', 'category_id');
    }

    public function Adds()
    {
        return $this->belongsTo('App\Ads', 'item_id');
    }
}
