<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geo_Countries extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_countries';
    public $timestamps = false;

    public function user_details()
    {
        return $this->hasMany('App\User_Details');
    }
}
