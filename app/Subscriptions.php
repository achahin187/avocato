<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriptions extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'subscriptions';
	protected $fillable = ['user_id', 'package_type_id', 'start_date', 'end_date', 'duration',
	'value', 'number_of_installments', 'is_active', 'created_at', 'updated_at'];
	protected $dates = ['start_date', 'end_date'];

	public function user() {
		return $this->belongsTo('App\Users', 'id');
	}

	public function package_type() {
		return $this->belongsTo('App\Package_Types');
	}
}
