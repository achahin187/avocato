<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Document extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_documents';

    protected $fillable = ['name','case_id','notes','is_verified','created_by','created_at','reviewed_by','reviewed_at'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];


     //relations
    public function cases()
    {
    	return $this->belongsTo('App\Case', 'case_id');
    }


     public function case_document_details()
    {
        return $this->hasMany('App\Case_Document_Details', 'case_document_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Users', 'created_by');
    }
}
