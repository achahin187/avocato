<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Case_Client_Role extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'case_client_roles';

    protected $fillable = ['name'];
    protected $date = [];
    public $timestamps = false;
    public static $rules = [
        // Validation rules
        
 		
    ];

    public function case_clients()
    {
    	return $this->hasMany('App\Case_Client', 'case_client_role_id');
    }
}
