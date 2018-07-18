<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 07/03/2018
 * Time: 01:09 م
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class TartFloors extends Model
{
    protected $primaryKey = 'floors_id';
    protected $table = 'tart_floors';
    protected $fillable = ['floorsar', 'flooren', 'price'];

    public function getFloorsarAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->flooren;
        return $value;
    }

}