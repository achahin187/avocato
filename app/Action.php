<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'actions';

    protected $fillable = ['name','name_ar'];
    protected $dates = [];
    public $timestamps = false;

    public function logs()
    {
        return $this->hasMany('App\Log','action_id');
    }
}
