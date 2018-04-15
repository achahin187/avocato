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


    //relations
    public function cases()
    {
    	return $this->belongsTo('App\Case', 'case_id');
    }

    public function case_client_roles()
    {
    	return $this->belongsTo('App\Case_Client_Role', 'case_client_role_id');
    }

    
}
