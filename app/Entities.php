<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'entities';
    public $timestamps = false;

        public function localizations()
    {
        return $this->hasMany('App\Entity_Localizations','entity_id');
    }
}
