<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geo_Cities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_cities';
    protected $fillable = ['governorate_id', 'name'];
    protected $hidden = ['id', 'created_at', 'updated_at','country_id'];
    public $timestamps = true;

        public function governorate()
    {
        return $this->belongsTo('App\Geo_Governorates','governorate_id')->withDefault();
    }

        public function courts()
    {
        return $this->hasMany('App\Courts','city_id');
    }
        public function cases()
    {
        return $this->hasMany('App\Case_', 'geo_city_id');
    }

        public function users_details()
    {
        return $this->hasMany('App\User_Details','work_sector_area_id');
    }
}
