<?php

namespace App;
use App\Users_Rules;
use App\Installment;
use App\ClientsPasswords;
use App\Task_Charges;
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

   // Delete user data from users_rules, user_details, subscriptions, installments and if user is a individual-company delete its record from user_company_detail
   protected static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            if ( count($user->rules)>0 ) { Users_Rules::where('user_id',$user->id)->delete(); }
            if ( count($user->client_password->id)>0 ) { ClientsPasswords::where('user_id', $user->id)->delete(); }
            if ( count($user->user_detail->id)>0 ) { $user->user_detail()->delete(); }
            if ( count($user->subscription->id)>0 ) { 
                if ( Installment::where('subscription_id', $user->subscription->id)->get() ) {
                    Installment::where('subscription_id', $user->subscription->id)->delete();
                }
                $user->subscription()->delete(); 
            }
            if ( count($user->user_company_detail->id)>0) { $user->user_company_detail()->delete(); }
            if ( count($user->tasks)>0) { 
              foreach($user->tasks as $task){
                if ( Task_Charges::where('task_id', $task->id)->get() ) {
                    Task_Charges::where('task_id', $task->id)->delete();
                }
              }
              }
            if ( count($user->offices)>0 ) {$user->offices()->delete();}
                // for companies or individuals_companies
        });
    }


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
       $result = $query->select('users_rules.id as ur_id', 'users.*')
                           ->join('users_rules', 'users.id', '=', 'users_rules.user_id')
                           ->where('users_rules.rule_id', $user_rule_id);
   }

   // One user in 'users' table has One record in 'clients_passwords' table
   public function client_password() {
       return $this->hasOne('App\ClientsPasswords','user_id');
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

    public function consultations()
   {
       return $this->belongsToMany('App\Consultation','consulation_lawyers','consultation_id','lawyer_id');
   }

   public function cases()
    {
        return $this->belongsToMany('App\Case_','case_lawyers','case_id','lawyer_id');
    }
    public function clients()
    {
        return $this->belongsToMany('App\Case_','case_clients','case_id','client_id')->withPivot('case_client_role_id', 'attorney_number');
}

    public function tasks()
    {
        return $this->hasMany('App\Tasks','client_id');

    }

    public function offices()
    {
        return $this->hasMany('App\User_Offices','user_id');

    }

    public function tasks_assigned()
    {
        return $this->hasMany('App\Tasks','assigned_lawyer_id');

    }

    public function who_assign_tasks()
    {
        return $this->hasMany('App\Tasks','who_assigned_lawyer_id');

    }

    public function case_technical_reports()
    {
      return $this->hasMany('App\Case_Techinical_Report', 'assigned_to');
        }
}
