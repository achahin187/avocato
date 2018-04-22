<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tasks extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'tasks';
    protected $fillable = ['case_id','name','description','level','roll','assigned_lawyer_id','client_id','who_assigned_lawyer_id','task_type_id','task_status_id','task_payment_status_id','expenses','start_datetime','end_datetime','next_datetime','task_address','client_longitude','client_latitude','created_by','updated_by'];
    protected $dates = ['end_datetime','start_datetime'];
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

    public function lawyer()
    {
        return $this->belongsTo('App\Users','assigned_lawyer_id');
    }
    

    public function who_assign_lawyer()
    {
        return $this->belongsTo('App\Users','who_assigned_lawyer_id');
    }

    public function charges()
    {
        return $this->hasMany('App\Task_Charges','task_id');
    }
    
    public function case()
    {
        return $this->belongsTo('App\Case_', 'case_id');
    }

    public function techinical_reports_emergency()
    {
        return $this->hasOne('App\Case_Techinical_Report','item_id');
    }

    public function task_status_history()
    {
        return $this->hasMany('App\Task_Status_History','task_id');
    }
}

