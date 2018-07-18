<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class tartadds extends Model
{

    protected $table = 'tart_adds';
    protected $primaryKey = 'adds_id';

    protected $fillable = ['add_namear', 'add_nameen', 'add_quantity', 'add_price', 'add_image'];

    public function Cart()
    {
        return $this->belongsTo('App\Cart', 'user_id');

    }

    public function getAddNamearAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->add_nameen;
        return $value;
    }

}
