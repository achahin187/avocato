<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Offices extends Model
{
	use SoftDeletes;

    protected $primaryKey = 'id';
   	protected $table = 'user_offices';
 	public $timestamps = false;


   public function user()
   {
       return $this->belongsTo('App\Users', 'user_id');
   }

}
