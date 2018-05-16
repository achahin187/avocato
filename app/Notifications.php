<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'notifications';
	public $timestamps = false;
    protected $fillable = ['msg', 'entity_id', 'item_id', 'user_id', 'notification_type_id', 'is_read', 'is_sent','created_at','schedule'];

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


        public function user()
    {
        return $this->belongsTo('App\Users','user_id');
    }
}
