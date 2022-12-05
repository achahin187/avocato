<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Helper;
class Notifications extends Model
{

    protected $primaryKey = 'id';
    protected $table = 'notifications';
    public $timestamps = false;
    protected $fillable = ['msg', 'entity_id', 'item_id','item_name', 'user_id', 'notification_type_id', 'is_read', 'is_sent','created_at','is_push','schedule','notification_schedule_id','country_id','item_user_id','action'];

    protected $dates = ['schedule'];
    
    public static function boot() {
        parent::boot();

        static::deleting(function($notification) { // before delete() method call this
             $notification->noti_items()->delete();
             // do the rest of the cleanup...
        });
    }

    // public function getMsgAttribute($value)
    // {
    //     $result = (\App::isLocale('ar')) ? Helper::localizations('notification_types','msg',$this->notification_type_id,1) : Helper::localizations('notification_types','msg',$this->notification_type_id,2);
    //     return ($result==null)? $value : $result;
    // }
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
