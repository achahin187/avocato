<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications_Push extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notifications_push';
    public $timestamps = false;
    protected $fillable = ['notification_id', 'device_token', 'mobile_os', 'lang_id','user_id'];

    public function notification()
    {
        return $this->belongsTo('App\Notifications','notification_id');
    }
     

}
