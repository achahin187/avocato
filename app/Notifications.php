<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notifications';
	public $timestamps = true;
	protected $dates = ['schedule'];

	    public function type()
    {
        return $this->belongsTo('App\notification_types','notification_type_id');
    }

    	public function noti_items()
    {
        return $this->hasMany('App\Notification_Items','notification_id');
    }

        public function push()
    {
        return $this->hasMany('App\notifications_push','notification_id');
    }

}
