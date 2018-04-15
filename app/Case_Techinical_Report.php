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


     //relations
    public function cases()
    {
    	return $this->belongsTo('App\Case', 'case_id');
    }

    public function case_tachinical_report_documents()
    {
    	return $this->hasMany('App\Case_Techinical_Report_Document', 'case_techinical_report_id');
    }

        public function lawyer()
    {
        return $this->belongsTo('App\Users', 'assigned_to');
    }

}
