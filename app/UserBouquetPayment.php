<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBouquetPayment extends Model
{
    protected $table = 'user_bouquet_payment';
    protected $fillable = ['bouquet_id', 'user_id','payment_method','period','start_date','end_date','payment_status','actuall_start_date','actuall_end_date','comment','price'];

    
    public $timestamps = false;
    public function payment_method()
    {
        return $this->belongsTo('App\BouquetPaymentMethod','payment_method');
    }
}
