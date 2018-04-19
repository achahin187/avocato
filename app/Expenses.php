<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expenses extends Model
{
	use SoftDeletes;
   protected $primaryKey = 'id';
   protected $table = 'expenses';
   public $timestamps = false;
   protected $dates = ['expensed_at'];

   public function lawyer()
{
    return $this->belongsTo('App\Users', 'lawyer_id')->withDefault();
}

}
