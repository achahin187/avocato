<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'book_recorders';
    protected $fillable = ['number', 'pen', 'client_id', 'delivery_date', 'delivered_at', 'session_date', 'notes', 'created_by', 'updated_by'];
    public $timestamps = true;
    protected $dates = ['delivery_date', 'delivered_at', 'session_date'];
    // relations
}
