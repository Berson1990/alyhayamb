<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table='cart';
    protected $primaryKey='cart_id';
    protected $fillable = ['item_id','user_id','category_id','sub_category_id','quantity','state','order_id'];

    public function items()
    {
        return $this->belongsTo('App\Items','item_id');
    }
    public function historyinfo()
    {
        return $this->hasOne('App\historyinfo','order_id');
    }
    public function itemimages()
    {
        return $this->belongsTo('App\itemimages','itemimages_id');
    }
    public function favorites()
    {
        return $this->belongsTo('App\favorites','item_id');
    }
//    public function tartAdds()
//    {
//        return $this->hasMany('App\tart_adds','add_id');
//
//    }
    public function tartAddCollector()
    {
        return $this->belongsTo('App\tartAddCollector','tartadds_id');
    }
    public function tartColorCollector()
    {
        return $this->belongsTo('App\tartcolorhandler','color_id');
    }

    public function tartColor()
    {
        return $this->hasMany('App\TartColor','color_id');
    }
    public function tartSize()
    {
        return $this->hasMany('App\TartSize','size_id');
    }
}
