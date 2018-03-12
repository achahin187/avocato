<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courts extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'courts';
    public $timestamps = true;

        public function city()
    {
        return $this->belongsTo('App\Geo_Cities','city_id');
    }
}
