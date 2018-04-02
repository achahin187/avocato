<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Record extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_records';

    protected $fillable = ['case_id','record_number','record_type_id','record_date','created_by','updated_by'];
    protected $date = [];
    public $timestamps = true;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];


     //relations
    public function cases()
    {
    	return $this->belongsTo('App\Case', 'case_id');
    }
    public function case_record_types()
    {
    	return $this->belongsTo('App\Case_Record_Type', 'record_type_id');
    }
    public function case_record_documents()
    {
    	return $this->hasMany('App\Case_Record', 'record_id');
    }
}
