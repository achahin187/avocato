<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

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

    public function getNameAttribute($value)
    {
        $lang = Session::get('AppLocale');
        if($lang == 2 or $lang == 3){
            return Helper::localizations('consultation_types' , 'name' , $this->id , $lang);
        }else{
            return $value;
        }
    }
}
