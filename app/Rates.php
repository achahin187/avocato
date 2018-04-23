<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rates extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'rates';
    public $timestamps = false;

		public function lawyer()
    {
        return $this->hasMany('App\User_Ratings','rate_id');
    }
}
