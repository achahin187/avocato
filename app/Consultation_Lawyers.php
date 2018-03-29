<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation_Lawyers extends Model
{
     protected $primaryKey = 'id';
    protected $table = 'consulation_lawyers';
    protected $fillable = ['lawyer_id','consultation_id','assigned_by','assigned_at'];
   
    public $timestamps = false;
    
}
