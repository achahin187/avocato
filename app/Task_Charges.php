<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Charges extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'task_charges';
    public $timestamps = true;
    protected $dates = ['date'];
   	
   		public function task()
    {
        return $this->belongsTo('App\Tasks','task_id');
    } 	

}
