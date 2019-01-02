<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'notifications';
    public $timestamps = false;
    protected $fillable = ['msg', 'entity_id', 'item_id', 'user_id', 'notification_type_id', 'is_read', 'is_sent','created_at','is_push','schedule','notification_schedule_id'];

    protected $dates = ['schedule'];
    
    public static function boot() {
        parent::boot();

        static::deleting(function($notification) { // before delete() method call this
             $notification->noti_items()->delete();
             // do the rest of the cleanup...
        });
    }

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
