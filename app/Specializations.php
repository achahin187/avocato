<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;
use App\Helpers\Helper;

class Specializations extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'specializations';
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany('App\Users','user_specializations','user_id','specialization_id');
    }

    public function getNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('specializations' , 'name' , $this->id , $lang);
        }else{
            return $this->attributes['name'];
        }
    }
}
