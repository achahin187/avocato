<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cases_types';
    public $timestamps = true;

    //relations
    public function cases()
    {
    	return $this->hasMany('App\Case_', 'case_type_id');
    }
}
