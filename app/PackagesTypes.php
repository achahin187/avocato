<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackagesTypes extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'package_types';
    public $timestamps = true;

    public function subscriptions() {
        return $this->hasMany('App\Subscription');
    }
}
