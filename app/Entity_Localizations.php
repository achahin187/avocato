<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity_Localizations extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'entity_localizations';
    protected $fillable=['field','item_id','value'];
    public $timestamps = false;

        public function entity()
    {
        return $this->belongsTo('App\Entities','entity_id');
    }
}
