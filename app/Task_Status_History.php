<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Status_History extends Model
{
     protected $primaryKey = 'id';
    protected $table = 'task_status_histories';
    protected $fillable = ['task_id', 'task_status_id','datetime','user_id'];
    public $timestamps = false;

        public function tasks()
    {
        return $this->belongsTo('App\Tasks','task_id');
    }

}
