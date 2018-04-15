<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rules extends Model
{
   protected $primaryKey = 'id';
   protected $table = 'rules';


   public function users()
   {
       return $this->belongsToMany('App\Users','users_rules','user_id','rule_id');
   }

       public function parent()
   {
       return $this->belongsTo('App\Rules', 'parent_id');
   }

       public function children()
   {
       return $this->hasMany('App\Rules', 'parent_id');
   }
}