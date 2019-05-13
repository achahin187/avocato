<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BouquetPaymentMethod extends Model
{
    protected $table="bouquet_payment_methods";


    public function bouquet()
    {
        return $this->belongsToMany('App\Bouquet', 'bouquets_methods' , 'payment_method_id' , 'bouquet_id');
    }
}
