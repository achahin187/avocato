<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class AcademicDegree extends Model
{
    public function getTitleAttribute($value)
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('academic_degrees' , 'title' , $this->id , $lang);
        }else{
            // return $this->attributes['name'];
            return $value;
        }
    }
}
