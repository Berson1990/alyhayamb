<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 19/03/2018
 * Time: 01:24 م
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class Branches extends Model
{

    protected $table = 'branches';
    protected $primaryKey = 'branches_id';
    protected $fillable = ['branche_name','branche_nameen','adress', 'addressen', 'branches_id', 'lat', 'lat'];

    public function BranchesPhone()
    {
        return $this->hasMany('App\BranchesPhones', 'branches_id');
    }

    public function getAdressAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->addressen;
        return $value;
    }
    public function getBrancheNameAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->branche_nameen;
        return $value;
    }
}