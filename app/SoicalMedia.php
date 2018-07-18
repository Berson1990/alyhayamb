<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/04/2018
 * Time: 12:50 م
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class SoicalMedia extends Model
{
    protected $primaryKey = 'social_media_id';
    protected $table = 'social_media';
    protected $fillable = ['facebook','twitter','instgram','skype'];
}