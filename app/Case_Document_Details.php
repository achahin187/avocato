<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Document_Details extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_document_details';

    // protected $fillable = ['record_id','name','file'];
    // protected $date = [];
    // public $timestamps = false;
    // public static $rules = [
    //     // Validation rules
        
 		
 		
    // ];

     public function case_documents()
    {
    	return $this->belongsTo('App\Case_Document', 'case_document_id');
    }
}
