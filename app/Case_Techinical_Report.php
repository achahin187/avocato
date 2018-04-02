<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Techinical_Report extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_techinical_reports';

    protected $fillable = ['name','case_id','technical_report_type_id','item_id','body','assigned_to','assigned_at','created_by','updated_by'];
    protected $date = [];
    public $timestamps = true;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];
}
