<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Record_Document extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_record_documents';

    protected $fillable = ['record_id','name','file'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];
}
