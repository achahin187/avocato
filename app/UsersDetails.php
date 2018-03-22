<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersDetails extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'user_details';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Users');
    }
}
