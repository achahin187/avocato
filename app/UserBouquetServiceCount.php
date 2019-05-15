<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBouquetServiceCount extends Model
{
    protected $table = 'users_bouquets';
    protected $fillable = ['service_id', 'user_id','count' , 'bouquet_id' , 'count_all' , 'used'];


    public function bouquet()
    {
        return $this->belongsTo('App\Bouquet', 'bouquet_id');
    }
}
