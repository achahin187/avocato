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
       return $this->hasMany('App\User_Details','nationality_id');
   }

	//there is no any relation so don't use it (the fk id is different)
        public function localizations()
    {
        return $this->hasMany('App\Entity_Localizations','item_id');
    }
}
