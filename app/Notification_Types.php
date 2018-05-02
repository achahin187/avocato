<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notification_types';
	public $timestamps = false;

	public function notifications()
    {
        return $this->hasMany('App\notifications','notification_type_id');
    }
}
