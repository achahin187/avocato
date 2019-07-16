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

    public function getNameAttribute()
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return  (Helper::localizations('case_record_types' , 'name' , $this->id , $lang) != null) ? Helper::localizations('case_record_types' , 'name' , $this->id , $lang) : $this->attributes['name'];
        }else{
            return $this->attributes['name'];
        }
    }

     public function case_records()
    {
    	return $this->hasMany('App\Case_Record', 'record_type_id');
    }
}
