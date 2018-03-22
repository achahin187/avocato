<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    protected $id    = 'id';
    protected $table = 'installments';
    protected $fillable = ['subscription_id', 'installment_number', 'value', 'payment_date', 'is_paid', 'created_at', 'updated_at'];
}
