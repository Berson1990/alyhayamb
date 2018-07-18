<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 20/03/2018
 * Time: 02:40 م
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TartOption extends Model
{
    protected $primaryKey = 'tart_option_id';
    protected $table = 'tart_option';
    protected $fillable = ['item_id', 'floors_id', 'size_id'];

    public function TartItem()
    {
        return $this->belongsTo('App\Item', 'item_id');
    }

    public function TartFloor()
    {
        return $this->belongsTo('App\TartFloors', 'floors_id');
    }

    public function TartSize()
    {
        return $this->belongsTo('App\TartSize', 'size_id');
    }
}