<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientsPasswords extends Model
{
    use SoftDeletes;
    protected $id   = 'id';
    protected $fillable = ['user_id', 'password', 'confirmation'];
    protected $dates = ['deleted_at'];

    // inverse one to one realation
    public function user() {
        return $this->belongsTo('App\Users','user_id')->withDefault();
    }
}
