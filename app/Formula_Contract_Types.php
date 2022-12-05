<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class Formula_Contract_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'formula_contract_types';
    public $timestamps = true;
        public function parent()
    {
        return $this->belongsTo('App\Formula_Contract_Types', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Formula_Contract_Types', 'parent_id');
    }

    public function formula_contracts()
    {
        return $this->hasMany('App\Formula_Contracts','formula_contract_types_id');
    }

    // public function getNameAttribute()
    // {
    //     $lang = Session::get('AppLocale');
    //     if($lang == 2 or $lang == 3){
    //         return Helper::localizations('formula_contract_types' , 'name' , $this->id , $lang);
    //     }else{
    //         return $this->attributes['name'];
    //     }
    // }
}
