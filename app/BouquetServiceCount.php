<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BouquetServiceCount extends Model
{
    protected $table = "bouquets_services_counts";
    protected $fillable = ['bouquet_id','bouquet_service_id','service_count','service_active'];
    
    public $timestamps = false;

   ///relation
    public function bouquet()
    {
        return $this->belongsTo('App\Bouquet','bouquet_id');
    }
}
