<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Techinical_Report_Document extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_technical_report_documents';

    protected $fillable = ['case_techinical_report_id','file'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];

    public function case_tachinical_reports()
    {
    	return $this->belongsTo('App\Case_Techinical_Report', 'case_techinical_report_id');
    }
}
