<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity_Localizations extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'entity_localizations';
    public $timestamps = false;
}
