<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'task_types';
    public $timestamps = false;

        public function tasks()
    {
        return $this->hasMany('App\Tasks','task_type_id');
    }
}
