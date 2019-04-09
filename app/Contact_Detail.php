<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact_Detail extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'contact_details';
    protected $fillable = ['contact_detail_type','name','code','value','icon','photo','is_default','company_branch_id'];
    public $timestamps = true;
}
