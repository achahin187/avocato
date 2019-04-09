<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_Branch extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'company_branches';
    protected $fillable = ['name','address','longtiude','latitude','is_main'];
    public $timestamps = true;

    //relation
    public function contact_detail()
    {
    	return $this->belongsToMany('App\Contact_Detail_Type','contact_details','company_branch_id','contact_detail_type')->withPivot('name', 'code','value','icon','photo','is_default');
    }
}
