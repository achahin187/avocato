<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geo_Governorates extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_governorates';
    protected $fillable = ['name'];
    public $timestamps = true;

        public function cities()
    {
        return $this->hasMany('App\Geo_Cities','governorate_id');
    }
}
