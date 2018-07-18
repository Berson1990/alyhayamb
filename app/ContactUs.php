<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/04/2018
 * Time: 12:50 م
 */

namespace App;

use Illuminate\Support\Facades\App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    protected $table = 'contact_us';
    protected $primaryKey = 'contact_us_id';
    protected $fillable = ['phone_numbers','emails','address','address_en'];
    public function getAddressAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->address_en;
        return $value;
    }

}