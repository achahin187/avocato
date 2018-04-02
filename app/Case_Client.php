<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Client extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_clients';

    protected $fillable = ['case_id','client_id','case_client_role_id','attorney_number'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		
 		
    ];
}
