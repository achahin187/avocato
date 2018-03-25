<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPasswords extends Model
{
    protected $id   = 'id';
    protected $fillable = ['user_id', 'password', 'confirmation'];

    // inverse one to one realation
    public function user() {
        return $this->belongsTo('App\Users');
    }
}
