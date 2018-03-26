<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity_Localizations extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'entity_localizations';
    public $timestamps = false;

        public function entity()
    {
        return $this->belongsTo('App\Entities','entity_id');
    }

        public function lang()
    {
        return $this->belongsTo('App\Languages','lang_id');
    }
	//doesn't work correctly don't use it country()
        public function country()
    {
        return $this->belongsTo('App\Geo_Countries','item_id');
    }
}
