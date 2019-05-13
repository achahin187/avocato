<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\BouquetMethod;
use App\BouquetPrice;
use App\BouquetServiceCount;
use App\UserBouquet;
use App\UserBouquetPayment;
use App\UserBouquetServiceCount;
use Session;
use Helper;

class Bouquet extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'Bouquets';

    protected $fillable = ['name','description','bouquet_type','price','country_id'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [];

    protected static function boot() {
        parent::boot();

        static::deleting(function($bouquet) { // before delete() method call this
            if ( $bouquet->payment != '' && $bouquet->payment != NULL ) { 
                BouquetMethod::where('bouquet_id',$bouquet->id)->delete(); 
            }
            if ( $bouquet->price != '' && $bouquet->price != NULL ) { 
                BouquetPrice::where('bouquet_id',$bouquet->id)->delete(); 
            }
            if ( $bouquet->users != '' && $bouquet->users != NULL ) { 
                UserBouquet::where('bouquet_id',$bouquet->id)->delete(); 
                UserBouquetPayment::where('bouquet_id',$bouquet->id)->delete(); 
                UserBouquetServiceCount::where('bouquet_id',$bouquet->id)->delete(); 
            }
            if ( $bouquet->services != '' && $bouquet->services != NULL ) { 
                BouquetServiceCount::where('bouquet_id',$bouquet->id)->delete(); 
            }
          
        });
    }

    //localizations
    public function getNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return  (Helper::localizations('bouquets' , 'name' , $this->id , $lang) != null) ? Helper::localizations('bouquets' , 'name' , $this->id , $lang) : $this->attributes['name'];
        }else{
            return $this->attributes['name'];
        }
    }
    public function getDescriptionAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('bouquets' , 'description' , $this->id , $lang);
        }else{
            return $this->attributes['name'];
        }
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_bouquets', 'bouquet_id' , 'user_id')->withPivot('is_subscribed','is_active');
    }

    public function payment()
    {
        return $this->belongsToMany('App\BouquetPaymentMethod', 'bouquets_methods', 'bouquet_id' , 'payment_method_id');
    }

    public function price_relation()
    {
        return $this->hasMany('App\BouquetPrice', 'bouquet_id' );
    }
    public function services()
    {
        return $this->belongsToMany('App\BouquetService','bouquets_services_counts' ,'bouquet_id' ,'bouquet_service_id')->withPivot('service_count','service_active');
    }
}
