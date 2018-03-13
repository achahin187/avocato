<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geo_Cities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_cities';
    protected $fillable = ['governorate_id', 'name'];
    public $timestamps = true;

        public function governorate()
    {
        return $this->belongsTo('App\Geo_Governorates','governorate_id');
    }

        public function courts()
    {
        return $this->hasMany('App\Courts','city_id');
    }
}
