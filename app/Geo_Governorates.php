<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class Geo_Governorates extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_governorates';
    protected $fillable = ['name','country_id'];
    public $timestamps = true;

    public function cities()
    {
        return $this->hasMany('App\Geo_Cities','governorate_id');
    }
    public function cases()
    {
        return $this->hasMany('App\Case_', 'geo_governorate_id');
    }

    public function getNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('geo_governorates' , 'name' , $this->id , $lang);
        }else{
            return $this->attributes['name'];
        }
    }
}
