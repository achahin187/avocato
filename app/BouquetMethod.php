<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BouquetMethod extends Model
{
    protected $table="bouquets_methods";
    protected $fillable = ['bouquet_id','payment_method_id'];

    public $timestamps = false;

    public function payment()
    {
        return $this->belongsTo('App\BouquetPaymentMethod','payment_method_id');
    }
}
