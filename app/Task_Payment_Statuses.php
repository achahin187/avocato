<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task_Payment_Statuses extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'task_payment_statuses';
    public $timestamps = false;

        public function tasks()
    {
        return $this->hasMany('App\Tasks','task_payment_status_id');
    }
}
