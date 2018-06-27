<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'logs';

    protected $fillable = ['action_id','entity_id','item_id','created_at','created_by'];
    protected $dates = [];
    public $timestamps = false;


    public function actions()
    {
        return $this->belongsTo('App\Action','action_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Users','created_by');
    }
}
