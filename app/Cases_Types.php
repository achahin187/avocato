<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'cases_types';
    public $timestamps = true;
}
