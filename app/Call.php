<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Call extends Model
{
    use SoftDeletes;

    public function caller()
    {
        return $this->belongsTo(Users::class, 'from');
    }

    public function receiver()
    {
        return $this->belongsTo(Users::class, 'to');
    }
}
