<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
use Helper;
class BouquetService extends Model
{
    protected $table="bouquet_services";

    public function getServiceNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return  (Helper::localizations('bouquet_services' , 'service_name' , $this->id , $lang) != null) ? Helper::localizations('bouquet_services' , 'service_name' , $this->id , $lang) : $this->attributes['service_name'];
        }else{
            return $this->attributes['service_name'];
        }
    }
}
