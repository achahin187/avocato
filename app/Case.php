<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cases';

    protected $fillable = ['name','office_file_number','claim_number','case_type_id','court_id','claim_year','claim_date','claim_expenses','geo_governorate_id','geo_city_id','region','case_startdate','case_enddate','contender_name','contender_case_client_role_id','contender_address','contender_laywer','case_body','case_notes','archived','archived_at','created_by','updated_by'];
    protected $date = [];
    public $timestamps = true;
    public static $rules = [
        // Validation rules
        
 		 		
    ];
// relations
    public function case_clients()
    {
    	return $this->hasMany('App\Case_Client', 'case_id');
    }
     public function case_documents()
    {
    	return $this->hasMany('App\Case_Document', 'case_id');
    }
     public function case_records()
    {
    	return $this->hasMany('App\Case_Record', 'case_id');
    }
     public function case_techinical_reports()
    {
    	return $this->hasMany('App\Case_Techinical_Report', 'case_id');
    }
     public function case_types()
    {
    	return $this->belongsTo('App\Cases_Types', 'case_type_id');
    }






    }
