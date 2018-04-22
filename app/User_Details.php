<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Details extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'user_details';
    protected $fillable = ['user_id', 'country_id', 'nationality_id', 'gender_id', 'job_title',
    'national_id', 'work_sector', 'work_sector_type', 'discount_percentage',
    'join_date', 'resign_date', 'is_resigned', 'authorization_copy', 'syndicate_copy', 'syndicate_level'];
    protected $dates = ['deleted_at'];
    public $timestamps = false;

public function nationality()
   {
       return $this->belongsTo('App\Geo_Countries','nationality_id')->withDefault(function($nationality){ foreach($nationality as $key=>$value){};});
   }
	public function user() {
		return $this->belongsTo('App\Users','user_id')->withDefault();
	}

}

