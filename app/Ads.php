<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 08/03/2018
 * Time: 04:29 م
 */

namespace App;

use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $primaryKey = 'ads_id';
    protected $table = 'ads';
    protected $fillable = ['item_id', 'state', 'offer','offeren'];

    public function item()
    {
        return $this->belongsTo('App\Items', 'item_id');
    }
    public function getOfferAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->offeren;
        return $value;
    }

}