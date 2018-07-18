<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TartColor extends Model
{

    protected $table='tart_color';
    protected $primaryKey='color_id';
    protected $fillable = ['tart_colorImage','color_name','color_discribtion'];
    //
//    public function items()
//    {
//        return $this->belongsTo('App\Items','item_id');
//    }
//       public function tartcolorhandler()
//    {
//        return $this->belongsTo('App\tartcolorhandler','tartcolorhandler_id');
//    }

}
