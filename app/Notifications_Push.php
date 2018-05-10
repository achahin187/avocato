<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications_Push extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notifications_push';
    public $timestamps = false;

    public function notification()
    {
        return $this->belongsTo('App\notifications','notification_id');
    }

}
