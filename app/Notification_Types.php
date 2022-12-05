<?php

namespace App;
use Helper;
use Illuminate\Database\Eloquent\Model;

class Notification_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notification_types';
	public $timestamps = false;


    public function getMsgAttribute($value)
    {
        $result = (\App::isLocale('ar')) ? Helper::localizations('notification_types','msg',$this->id,1) : Helper::localizations('notification_types','msg',$this->id,2);
        return ($result==null)? $value : $result;
    }

    
	public function notifications()
    {
        return $this->hasMany('App\notifications','notification_type_id');
    }
}
