<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Record_Type extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_record_types';

    protected $fillable = ['name'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 	
 		
    ];

     public function case_records()
    {
    	return $this->hasMany('App\Case_Record', 'record_type_id');
    }
}
