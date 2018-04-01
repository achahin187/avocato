<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'consultation_types';
    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;
    public function consultation()
    {
    	return $this->hasMany('App\Consultation', 'consultation_type_id');
    }
}
