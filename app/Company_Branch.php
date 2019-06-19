<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Session;

class Company_Branch extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'company_branches';
    protected $fillable = ['name','address','longitude','latitude','is_main'];
    public $timestamps = true;

    //relation
    public function contact_detail()
    {
    	return $this->belongsToMany('App\Contact_Detail_Type','contact_details','company_branch_id','contact_detail_type')->withPivot('name', 'code','value','icon','photo','is_default');
    }

    public function getNameAttribute($value)
    {
        // Temporary fix
        //Needs to be changed according to language
        //next release contact_us will have more than one language saved at the same time
     
        if($value == null){
            $lang = Session::get('AppLocale');
            $newValue = Helper::localizations('company_branches' , 'name' , $this->id , $lang); 
            return $newValue ;
            
        }else{
            return $value;
        }


    }

    public function getAddressAttribute($value)
    {
        // Temporary fix
        //Needs to be changed according to language
        //next release contact_us will have more than one language saved at the same time
     
        if($value == null){
            $lang = Session::get('AppLocale');
            $newValue = Helper::localizations('company_branches' , 'address' , $this->id , $lang); 
            return $newValue ;
            
        }else{
            return $value;
        }


    }
}
