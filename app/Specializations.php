<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specializations extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'specializations';
    public $timestamps = true;

        public function users()
    {
        return $this->belongsToMany('App\Users','user_specializations','user_id','specialization_id');
    }



}
