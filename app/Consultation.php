<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'consultations';
    protected $fillable = ['code','consultation_type_id','is_paid','question','created_by','created_at','is_replied'];
    protected $date = ['id', 'created_at'];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		"question"=>"required",
 		
    ];
}
