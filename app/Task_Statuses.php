<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Statuses extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'task_statuses';
    public $timestamps = false;

        public function tasks()
    {
        return $this->hasMany('App\Tasks','task_status_id');
    }
}
