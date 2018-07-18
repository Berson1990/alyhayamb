<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TartSize extends Model
{
    protected $table='tart_size';
    protected $primaryKey='size_id';
    protected $fillable = ['size_name','size_no','size_price'];
    //
}
