<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/04/2018
 * Time: 03:40 م
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    protected $fillable = ['user_id', 'order_state', 'location_id', 'payment', 'total_price', 'delegate_id'];

    public function OrderDeatails()
    {
        return $this->hasMany('App\OrderDetails', 'order_id');
    }

    public function Users()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Location()
    {
        return $this->belongsTo('App\Userorderlocations', 'location_id');
    }




}