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
}
