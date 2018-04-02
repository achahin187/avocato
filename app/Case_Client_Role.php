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
}
