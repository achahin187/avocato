<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class Courts extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'courts';
    public $timestamps = true;

    public function city()
    {
        return $this->belongsTo('App\Geo_Cities','city_id')->withDefault();
    }

    public function cases()
    {
        return $this->hasMany('App\Case_', 'court_id');
    }

    public function getNameAttribute($value)
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('courts' , 'name' , $this->id , $lang);
        }else{
            // return $this->attributes['name'];
            return $value;
        }
    }
}
