<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class SubCategory extends Model
{
    protected $primaryKey = 'sub_category_id';
    protected $fillable = ['subcategroy_namear', 'subcategory_nameen', 'categories_id'];
    protected $table = 'sub_category';

    public function getSubcategroyNamearAttribute($value)
    {
        if (App::getLocale() == 'en')
            $value = $this->subcategory_nameen;
        return $value;
    }

}