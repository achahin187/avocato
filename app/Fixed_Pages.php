<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;

class Fixed_Pages extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'fixed_pages';
    protected $fillable = ['name', 'content'];
    public $timestamps = true;

    // public function getContentAttribute()
    // {
    //     $lang = Session::get('AppLocale');
    //     if($lang == 2 or $lang == 3){
    //         return Helper::localizations('formula_contract_types' , 'name' , $this->id , $lang);
    //     }else{
    //         return $this->attributes['name'];
    //     }
    // }
}

