<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Ratings extends Pivot
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'user_ratings';
    public $timestamps = false;
    protected $dates = ['created_at'];

        public function rate_type()
    {
        return $this->belongsTo('App\Rates','rate_id');
    }
}
