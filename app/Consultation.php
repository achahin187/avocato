<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'consultations';

    protected $fillable = ['code','consultation_type_id','is_paid','question','created_by','created_at','is_replied'];
    protected $dates = ['created_at'];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		"question"=>"required",
 		
    ];
    public function consultation_type()
    {
    	return $this->belongsTo('App\Consultation_Types', 'consultation_type_id');
    }
    public function consultation_reply()
    {
        return $this->hasMany('App\Consultation_Replies', 'consultation_id');
    }

     public function lawyers()
   {
       return $this->belongsToMany('App\Users','consulation_lawyers','consultation_id','lawyer_id');
   }
}
