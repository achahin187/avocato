<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPasswords extends Model
{
    protected $fillable = ['user_id', 'password', 'confirmation', 'created_at', 'updated_at'];

    // inverse one to one realation
    public function user() {
        return $this->belongsTo('App\Users');
    }
}
