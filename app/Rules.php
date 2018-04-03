<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rules extends Model
{
    use SoftDeletes; 
    protected $primaryKey = 'id';
    protected $table = 'rules';
    protected $dates = ['deleted_at'];
    protected $softDelete = false;

    public function users()
    {
        return $this->belongsToMany('App\Users','users_rules','user_id','rule_id');
    }

        public function parent()
    {
        return $this->belongsTo('App\Rules', 'parent_id');
    }

    	public function children()
    {
        return $this->hasMany('App\Rules', 'parent_id');
    }
}
