<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Statics extends Model
{
    protected $table='statics';
    protected $primaryKey='statics_id';

    public function getStaticsNameArAttribute($value) {
        if(App::getLocale() == 'en')
            $value = $this->statics_name_en;
        return $value;
    }

}
