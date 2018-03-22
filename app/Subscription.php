<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'subscriptions';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Users');
    }

    public function package_type() {
        return $this->belongsTo('App\PackagesTypes');
    }
}
