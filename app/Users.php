<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
	use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'users';
    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function createdParent()
    {
        return $this->belongsTo('App\Users', 'created_by');
    }

    public function createdChildren()
    {
        return $this->hasMany('App\Users', 'created_by');
    }

    public function modifiedParent()
    {
        return $this->belongsTo('App\Users', 'modified_by');
    }

    public function modifiedChildren()
    {
        return $this->hasMany('App\Users', 'modified_by');
    }

    public function rules()
    {
        return $this->belongsToMany('App\Rules','users_rules','user_id','rule_id');
    }

    public function user_detail() {
        return $this->belongsTo('App\UsersDetails');
    }

    public function subscription() {
        return $this->belongsTo('App\Subscription', 'user_id');
    }
}
