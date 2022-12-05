<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification_Items extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'notification_items';
	public $timestamps = false;

	    public function notification()
    {
        return $this->belongsTo('App\notifications','notification_id');
    }

}
