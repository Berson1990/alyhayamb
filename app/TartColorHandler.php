<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 25/03/2018
 * Time: 10:34 ص
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TartColorHandler extends Model
{
    protected $table = 'tartcolorhandler';
    protected $fillable = ['color_id', 'tart_color_id'];
    protected $primaryKey = 'tartcolorhandler_id';

}