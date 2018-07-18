<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TartCart extends Model
{

    protected $table = 'tart_cart';
    protected $primaryKey = 'tart_cart_id';
    protected $fillable = ['cart_id', 'state', 'adds_id', 'tart_image', 'tart_size_id', 'tart_additonals_id', 'tart_color_id', 'tart_text', 'floors_id'];

    public function TartAdds()
    {
        return $this->belongsTo('App\TartAdds', 'adds_id');

    }

    public function Cart()
    {
        return $this->belongsTo('App\Cart', 'user_id');

    }

    public function TartColorHandler()
    {
        return $this->hasMany('App\TartColorHandler', 'tart_cart_id');
    }

    public function TartAddional()
    {
        return $this->hasMany('App\TartAddional', 'tart_cart_id');
    }

}
