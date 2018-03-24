<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsPasswords extends Model
{

    // inverse one to one realation
    public function user() {
        return $this->belongsTo('App\Users');
    }
}
