<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Details extends Model
{
	protected $primaryKey = 'id';
	protected $table = 'user_details';
	protected $fillable = ['user_id', 'country_id', 'nationality_id', 'gender_id', 'job_title',
	'national_id', 'work_sector', 'work_sector_type', 'discount_percentage',
	'join_date', 'resign_date', 'is_resigned', 'authorization_copy', 'syndicate_copy', 'syndicate_level'];
	public $timestamps = true;

	public function user() {
		return $this->belongsTo('App\Users');
	}
}
