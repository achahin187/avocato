<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Company_Details extends Model
{
    use SoftDeletes;
    protected $primaryKey = 'id';
    protected $table = 'user_company_details';
    protected $fillable = ['user_id', 'commercial_registration_number', 'fax', 'website', 'legal_representative_name', 'legal_representative_mobile'];
    protected $dates = ['deleted_at'];
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\Users', 'user_id');
    }
}
