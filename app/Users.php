<?php

namespace App;
use App\Users_Rules;
use App\Installment;
use App\ClientsPasswords;
use App\Task_Charges;
use App\User_Ratings;
use App\OfficeBranches;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Users extends Authenticatable
{
    use SoftDeletes;
   protected $primaryKey = 'id';
   protected $table = 'users';
   protected $fillable = ['name', 'password', 'full_name', 'email', 'image',
                           'phone', 'mobile', 'tele_code','cellphone',
                           'address', 'code', 'birthdate',
                           'creditcard_number', 'creditcard_cvv', 'creditcard_month',
                           'creditcard_year', 'is_active', 'deleted_at', 'verificaition_code',
                           'is_verification_code_expired', 'last_login', 'api_token', 'device_token',
                           'created_by', 'modified_by', 'remember_token', 'created_at', 'updated_at','country_id','speed','speed_updated_at'];
   protected $dates = ['deleted_at'];
   public $timestamps = true;

   // Delete user data from users_rules, user_details, subscriptions, installments and if user is a individual-company delete its record from user_company_detail
   protected static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
            if ( $user->rules != '' && $user->rules != NULL ) { 
                Users_Rules::where('user_id',$user->id)->delete(); 
            }
            if ( $user->client_password != '' && $user->rules != NULL ) { 
                ClientsPasswords::where('user_id', $user->id)->delete(); 
            }
            if ( $user->user_detail != '' && $user->user_detail != NULL ) { 
                $user->user_detail()->delete(); 
            }
            if ( $user->subscription != '' && $user->subscription != NULL ) { 
                if ( Installment::where('subscription_id', $user->subscription->id)->get() ) {
                    Installment::where('subscription_id', $user->subscription->id)->delete();
                }
                $user->subscription()->delete(); 
            }
            if ( $user->user_company_detail != '' && $user->user_company_detail != NULL ) { 
                $user->user_company_detail()->delete(); 
            }
            
            if ( count($user->tasks)>0) { 
              foreach($user->tasks as $task){
                if ( Task_Charges::where('task_id', $task->id)->get() ) {
                    Task_Charges::where('task_id', $task->id)->delete();
                }
              }
              }

            //if ( OfficeBranches::where('office_id',$user->id)->count() >0 ) {OfficeBranches::where('office_id',$user->id)->delete();}
            // if ( count($user->offices)>0 ) {$user->offices()->delete();}
            // if ( count($user->expenses)>0 ) {$user->expenses()->delete();}
            // if ( count($user->rate)>0 ) {User_Ratings::where('user_id',$user->id)->delete();}
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
       return $this->hasOne('App\User_Details','user_id')->withDefault();
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
       return $this->hasOne('App\ClientsPasswords','user_id')->withDefault();
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

      return $this->hasMany('App\Case_Techinical_Report', 'assigned_to')->withDefault();
    }

        public function expenses()
    {
        return $this->hasMany('App\Expenses','lawyer_id');
    }

        public function rate()
    {
        return $this->belongsToMany('App\Users', 'user_ratings', 'user_id', 'created_by')->withPivot('notes','created_at','rate_id','id','is_approved')->using('App\User_Ratings');
    }

    public function getRole(){
      foreach($this->rules as $rule){
        if($rule->pivot->rule_id==1 or $rule->pivot->rule_id==2 or $rule->pivot->rule_id==3 or $rule->pivot->rule_id==4 ){
          return $rule->pivot->rule_id;
        }
      }
    }

        public function getClient(){
      foreach($this->rules as $rule){
        if($rule->pivot->rule_id==8 or $rule->pivot->rule_id==9 or $rule->pivot->rule_id==10){
          return $rule->pivot->rule_id;
        }
      }
    }
    public function IsOffice(){
        foreach($this->rules as $rule){
          if($rule->pivot->rule_id==15){
            return true;
          }
        }
        return false;
      }
      public function IsLawyer(){
        foreach($this->rules as $rule){
          if($rule->pivot->parent_id==5){
            return true;
          }
        }
        return false;
      }

          public function notifications()
    {
        return $this->hasMany('App\Notifications','user_id');
    }

    public function logs()
    {
        return $this->hasMany('App\Log','created_by');
    }

        public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

        public function specializations()
    {
        return $this->belongsToMany('App\Specializations','user_specializations','user_id','specialization_id');
    }

     public function offices_branches()
    {
        return $this->belongsToMany('App\OfficeBranches');
    }
    

    public function scopeDistance($query, $lat, $lng, $radius = 100, $unit = "km")
    {
        //   $R = 6378.10; // metres
        //   $dLat = deg2rad($lat - $this->latitude );
        //   $dLon = deg2rad($lng - $this->longtuide);
        //   $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($this->latitude)) * cos(deg2rad($lat)) * sin($dLon/2) * sin($dLon/2);
        //   $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        //   $d = round($R * $c); // Distance in km
        $unit = ($unit === "km") ? 6378.10 : 3963.17;
        $lat = (float) $lat;
        $lng = (float) $lng;
        $radius = (double) $radius;
        return $query->select(DB::raw("*,
                            ($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(latitude))
                                * COS(RADIANS($lng) - RADIANS(longtuide))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(latitude)))) AS distance")
            )->orderBy('distance','asc');
        // return $query->select(DB::raw("*,
        //                     (round($R * $c)) AS distance")
        //     )->orderBy('distance','asc');
    }
    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function bouquets()
    {
        return $this->belongsToMany('App\Bouquet', 'users_bouquets', 'user_id', 'bouquet_id')->withPivot('is_subscribed','is_active','start_date','end_date','duration','value','number_of_installments','payment_method_id');
    }
    public function bouquet_services()
    {
        return $this->belongsToMany('App\BouquetService', 'user_bouquet_service_count', 'user_id', 'service_id')->withPivot('count','all_count','used');
    }
    public function bouquet_payment()
    {
        return $this->belongsToMany('App\BouquetPaymentMethod', 'user_bouquet_payment', 'user_id', 'payment_method')->withPivot('period','payment_status','start_date','end_date','actuall_start_date','actuall_end_date','comment','price');
    }
}
