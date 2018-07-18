<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'categories_id';
    //
    protected $fillable = ['categoryname_ar', 'categoryname_en', 'category_image', 'category_status', 'category_activation'];

    public function SubCtegroy(){
        return $this->hasMany('App\SubCategory','categories_id');
    }
    public function getCategorynameArAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->categoryname_en;
        return $value;
    }
}


