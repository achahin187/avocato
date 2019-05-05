<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class Cases_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cases_types';
    public $timestamps = true;

    //relations
    public function cases()
    {
    	return $this->hasMany('App\Case_', 'case_type_id');
    }

    public function getNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('cases_types' , 'name' , $this->id , $lang);
        }else{
            return $this->attributes['name'];
        }
    }
}
