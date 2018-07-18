<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    protected $primaryKey = 'order_details_id';
    protected $fillable = ['order_id', 'item_id', 'qty'];

    public function Items()
    {
        return $this->belongsTo('App\Items', 'item_id');
    }
}