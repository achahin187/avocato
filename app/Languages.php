<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'languages';
    public $timestamps = false;

    public function localizations()
    {
    	return $this->hasMany('App\Entity_Localizations','lang_id');
    }
}
