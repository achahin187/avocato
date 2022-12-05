<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Task_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'task_types';
    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany('App\Tasks','task_type_id')->whereHas('created_by', function($query) {
        $query->where('country_id' ,Auth::user()->country_id);
    });
    }
}
