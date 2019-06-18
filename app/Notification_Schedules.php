<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification_Schedules extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'notification_schedules';
    public $timestamps = false;
    protected $fillable = ['name', 'schedule', 'created_at'];
    protected $dates = ['schedule','created_at'];


    public function noti_items()
    {
        return $this->hasMany('App\Notification_Items','notification_id');
    }

    
}
