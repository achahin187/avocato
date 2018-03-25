<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_Rules extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'users_rules';
    protected $fillable = ['user_id', 'rule_id'];
    public $timestamps = false;
}
