<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'tasks';
    protected $fillable = ['case_id','name','description','level','roll','assigned_lawyer_id','client_id','who_assigned_lawyer_id','task_type_id','task_status_id','task_payment_status_id','expenses','start_datetime','end_datetime','next_datetime','task_address','client_longitude','client_latitude','created_by','updated_by'];
    protected $date = [];
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
    
       public function cases()
    {
        return $this->belongsTo('App\Case_', 'case_id');
    }
}

