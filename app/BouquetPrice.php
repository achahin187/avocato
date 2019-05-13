<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BouquetPrice extends Model
{
    protected $table="bouquets_price";
    protected $fillable = ['bouquet_id','price','count_from','count_to'];
    public $timestamps = false;


    public function bouquet()
    {
        return $this->belongsTo('App\Bouquet','bouquet_id');
    }
}
