<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use SoftDeletes;
    protected $fillable = ['subscription_id', 'installment_number', 'value', 'payment_date', 'is_paid'];
    protected $dates = ['deleted_at'];
}
