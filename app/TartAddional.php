<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 25/03/2018
 * Time: 10:37 ص
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TartAddional extends Model
{
    protected $table = 'tart_addional';
    protected $primaryKey = 'tart_addional_id';
    protected $fillable = ['cart_tart_id', 'tart_adds_id'];

}