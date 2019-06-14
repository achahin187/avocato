<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBouquet extends Model
{
    protected $table = 'users_bouquets';
    protected $fillable = ['bouquet_id', 'user_id','payment_method_id','is_subscribed','is_active','start_date','end_date','duration','value','number_of_installments','price_method_id'];


    public $timestamps=false;
}
