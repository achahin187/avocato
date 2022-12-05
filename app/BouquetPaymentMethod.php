<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
use Helper;

class BouquetPaymentMethod extends Model
{
    protected $table="bouquet_payment_methods";
    

    public function getNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return  (Helper::localizations('bouquet_payment_methods' , 'name' , $this->id , $lang) != null) ? Helper::localizations('bouquet_payment_methods' , 'name' , $this->id , $lang) : $this->attributes['name'];
        }else{
            return $this->attributes['name'];
        }
    }

    public function bouquet()
    {
        return $this->belongsToMany('App\Bouquet', 'bouquets_methods' , 'payment_method_id' , 'bouquet_id');
    }
}
