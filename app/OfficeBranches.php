<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class OfficeBranches extends Model
{  //use SoftDeletes;
   protected $primaryKey = 'id';
   protected $table = 'office_branches';



      public function office()
   {
       return $this->belongsTo('App\Users', 'office_id');
   }

   public function city()
   {
       return $this->belongsTo('App\Geo_Cities', 'city_id');
   }

   public function country()
   {
       return $this->belongsTo('App\Geo_Countries', 'country_id');
   }
}
