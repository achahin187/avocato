<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'entities';
    protected $fillable=['name'];
    public $timestamps = false;

    public function localizations()
    {
        return $this->hasMany('App\Entity_Localizations','entity_id');
    }

    public function entity()
    {
        return $this->hasMany('App\Log','entity_id');
    }
}
