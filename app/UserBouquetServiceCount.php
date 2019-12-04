<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBouquetServiceCount extends Model
{
    protected $table = 'user_bouquet_service_count';
    protected $fillable = ['service_id', 'user_id','quota' , 'bouquet_id' , 'all_count' , 'used'];
    
    public $timestamps = false;

    public function bouquet()
    {
        return $this->belongsTo('App\Bouquet', 'bouquet_id');
    }
}
