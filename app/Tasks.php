<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tasks';
    public $timestamps = true;

        public function payment_status()
    {
        return $this->belongsTo('App\Task_Payment_Statuses','task_payment_status_id');
    }

        public function task_status()
    {
        return $this->belongsTo('App\Task_Statuses','task_status_id');
    }

        public function task_type()
    {
        return $this->belongsTo('App\Task_Types','task_type_id');
    }

        public function client()
    {
        return $this->belongsTo('App\Users','client_id');
    }

        public function charges()
    {
        return $this->hasMany('App\Task_Charges','task_id');
    }
}
