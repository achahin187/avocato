<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fixed_Pages extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'fixed_pages';
    public $timestamps = true;
}
