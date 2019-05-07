<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bouquet extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'Bouquets';

    protected $fillable = ['name','description','bouquet_type','price','country_id'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [];

    public function users()
    {
        return $this->belongsToMany('App\User', 'users_bouquets', 'bouquet_id' , 'user_id');
    }

    public function payment()
    {
        return $this->belongsToMany('App\BouquetPaymentMethod', 'bouquets_methods', 'bouquet_id' , 'payment_method_id');
    }

    public function price()
    {
        return $this->hasMany('App\BouquetPrice', 'bouquet_id' );
    }
    public function services()
    {
        return $this->belongsToMany('App\BouquetService','bouquets_services_counts' ,'bouquet_id' ,'bouquet_service_id')->withPivot('service_count','service_active');
    }
}
