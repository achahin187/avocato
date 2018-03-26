<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes;
   protected $primaryKey = 'id';
   protected $table = 'users';
   protected $fillable = ['name', 'password', 'full_name', 'email', 'image',
                           'phone', 'mobile', 'address', 'code', 'birthdate',
                           'creditcard_number', 'creditcard_cvv', 'creditcard_month',
                           'creditcard_year', 'is_active', 'deleted_at', 'verificaition_code',
                           'is_verification_code_expired', 'last_login', 'api_token', 'device_token',
                           'created_by', 'modified_by', 'remember_token', 'created_at', 'updated_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;

   public function createdParent()
   {
       return $this->belongsTo('App\Users', 'created_by');
   }

   public function createdChildren()
   {
       return $this->hasMany('App\Users', 'created_by');
   }

   public function modifiedParent()
   {
       return $this->belongsTo('App\Users', 'modified_by');
   }

   public function modifiedChildren()
   {
       return $this->hasMany('App\Users', 'modified_by');
   }

   // Many users in 'users' table have Many rules in 'rules' table - pivot table =>  'users_rules'
   public function rules()
   {
       return $this->belongsToMany('App\Rules','users_rules','user_id','rule_id');
   }

   // One user in 'users' table has One detail in 'user_details' table
   public function user_detail() {
       return $this->hasOne('App\User_Details','user_id');
   }

   // One user in 'users' table has One subscribtion in 'subscriptions' table
   public function subscription() {
       return $this->hasOne('App\Subscriptions', 'user_id');
   }

   // Join between 'users' && 'users_rules'
   // get all users with user_type is 8 => individuals only
   public function scopeUsers($query, $user_rule_id) {
       $result = $query->select('users_rules.id as ur_id', 'users.id', 'name', 'parent_id', 'full_name', 'email', 'image', 'phone', 'mobile', 'address', 'code', 'birthdate', 'creditcard_number', 'creditcard_cvv', 'creditcard_month', 'creditcard_year', 'is_active', 'deleted_at', 'verificaition_code', 'is_verification_code_expired', 'last_login', 'api_token', 'device_token', 'created_by', 'modified_by', 'remember_token')
                           ->join('users_rules', 'users.id', '=', 'users_rules.user_id')
                           ->where('users_rules.rule_id', $user_rule_id);
   }

   // One user in 'users' table has One record in 'clients_passwords' table
   public function client_password() {
       return $this->hasOne('App\ClientsPasswords');
   }

   public function user_company_detail() {
       return $this->hasOne('App\User_Company_Details', 'user_id');
   }

   // Self relation between individual and company
   public function companyParent()
   {
       return $this->belongsTo('App\Users', 'parent_id');
   }

   // Self relation
   public function companyChildren()
   {
       return $this->hasMany('App\Users', 'parent_id');
   }

}
