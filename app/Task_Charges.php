<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Charges extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tasks';
    public $timestamps = true;
   	
   		public function task()
    {
        return $this->belongsTo('App\Tasks','task_id');
    } 	

}
