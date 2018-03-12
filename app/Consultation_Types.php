<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'consultation_types';
    public $timestamps = true;
}
