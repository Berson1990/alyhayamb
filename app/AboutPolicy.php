<?php
/**
 * Created by PhpStorm.
 * User: mahmoud
 * Date: 01/04/2018
 * Time: 11:23 ص
 */

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;


class AboutPolicy extends Model
{
    protected $primaryKey = 'policy_about_id';
    protected $table = 'policy_about';
    protected $fillable = ['about_ar', 'about_en', 'policy_ar', 'policy_en'];

    public function getAboutArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->about_en;
        return $value;
    }
    public function getPolicyArAttribute($value)
    {

        if (App::getLocale() == 'en')
            $value = $this->policy_en;
        return $value;
    }
}