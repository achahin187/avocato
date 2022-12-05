<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Installment extends Model
{
    use SoftDeletes;
    protected $fillable = ['subscription_id', 'installment_number', 'value', 'payment_date', 'is_paid'];
    protected $dates = ['payment_date', 'deleted_at'];


	public function subscription() {
		return $this->belongsTo('App\Subscriptions', 'subscription_id')->whereHas('user', function($query) {
        $query->where('country_id' ,Auth::user()->country_id);
    });
	}
}
