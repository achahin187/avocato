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







    }
