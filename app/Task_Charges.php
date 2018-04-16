<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task_Charges extends Model
{
	use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'task_charges';
    public $timestamps = true;
    protected $dates = ['date'];
   	
   		public function task()
    {
        return $this->belongsTo('App\Tasks','task_id');
    } 	

}
