<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historyinfo extends Model
{
    protected $table='historyinfo';
    protected $primaryKey='historyinfo_id';
    //
    public function cart()
    {
        return $this->hasMany('App\cart','order_id');
    }
}
