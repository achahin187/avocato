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

    public function getContentAttribute(){
     
        return  Helper::localizations('fixed_pages','content',$this->id,$lang_id=null);
    }
}

