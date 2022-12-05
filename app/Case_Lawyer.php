<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Lawyer extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_lawyers';

    protected $fillable = ['case_id','lawyer_id'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];
}
