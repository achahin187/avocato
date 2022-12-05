<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SyndicateLevels extends Model
{
   protected $primaryKey = 'id';
    protected $table = 'syndicate_levels';
    public $timestamps = false;

    	public function user_details()
   {
       return $this->hasMany('App\User_Details','syndicate_level_id');
   }

}
