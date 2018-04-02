<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'package_types';
    public $timestamps = false;

    public function subscriptions() {
        return $this->hasMany('App\Subscriptions','package_type_id');
    }
}
