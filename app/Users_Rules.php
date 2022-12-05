<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users_Rules extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'users_rules';
    protected $fillable = ['user_id', 'rule_id'];
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    // protected $softDelete = false;
}
