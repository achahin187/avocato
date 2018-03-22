<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geo_Countries extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'geo_countries';
    public $timestamps = false;
}
