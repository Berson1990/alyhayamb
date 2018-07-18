<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 19/03/2018
 * Time: 01:26 م
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class BranchesPhones extends Model
{
    protected $fillable = ['phone_type', 'phone_typeen', 'phone', 'branches_id'];
    protected $primaryKey = 'branches_phones_id';
    protected $table = 'branches_phones';

    public function getPhoneTypeAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->phone_typeen;
        return $value;
    }
}