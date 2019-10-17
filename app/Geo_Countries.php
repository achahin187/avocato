<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class Geo_Countries extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_countries';
    public $timestamps = false;

    public function user_details()
    {
       return $this->hasMany('App\User_Details','nationality_id');
    }

    public function user_details_currency()
    {
       return $this->hasMany('App\User_Details','currency_id');
    }

	//there is no any relation so don't use it (the fk id is different)
    public function localizations()
    {
        return $this->hasMany('App\Entity_Localizations','item_id');
    }

    public function getNameAttribute($value)
    {
        $lang = Session::get('AppLocale');
        if($lang == 1 or $lang == 3){
            return Helper::localizations('geo_countries' , 'name' , $this->id , $lang);
        }else{
            return $value;
        }
    }

    public function getNationalityAttribute($value)
    {
        $lang = Session::get('AppLocale');
            if($lang == 1 or $lang == 3){
            return  (Helper::localizations('geo_countries' , 'name' , $this->id , $lang) != null) ? Helper::localizations('geo_countries' , 'name' , $this->id , $lang) : $value;
        }else{
            return $value;
        }
    }

    public function getCurrencyAttribute($value)
    {
        $lang = Session::get('AppLocale');
            if($lang == 1 or $lang == 3){
            return  (Helper::localizations('geo_countries' , 'currency' , $this->id , $lang) != null) ? Helper::localizations('geo_countries' , 'currency' , $this->id , $lang) : $value;
        }else{
            return $value;
        }
    }
}
