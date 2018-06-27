<?php 

namespace App\Helpers;
use Illuminate\Database\Eloquent\Model;
use App\Entities;
use App\Users;
use App\Case_;
use App\Tasks;
use App\Log;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class Helper {

    /**
     *  @param  Max range of random numbers $range
     *  How to use in controller:
     * 
     *  use Helper;
     *  Helper::generateRandom(Users::class, 'code', 6);
     */
    public static function generateRandom($model, $column, $range) {
        $min = 0;
        $max = 0;

        if ( $range == 0 || $range == null ) {
            return 0;
        }else if ( $range > 0 ) {
            $min = pow(10, $range-1);
            $max = pow(10, $range) - 1;
        }
        
        $random = mt_rand($min, $max);

        while ( $model::where($column, $random)->first() ) {
            $random = mt_rand($min, $max);
        }

        return $random;
    }

    /** 
     *  @param  $table_name     entities.name
     *  @param  $field          entity_localizations.field
     *  @param  $item_id        entity_localizations.item_id
     * 
     *  How to use: 
     *  Helper::localizations('package_types', 'name', 1);
     * 
     *  Result: 
     *  بلاتيني 
     */
    public static function  localizations($table_name , $field , $item_id)
    {
      $value_localized = Entities::where('name',$table_name)->with([
        'localizations' => function($query) use($field, $item_id)
        {
            $query->where('field', $field)->where('item_id', $item_id);
        }
      ])->get();
      foreach ($value_localized as  $value) {
        
        foreach ($value->localizations as $value1) {
            return $value1->value;       
        }
      }
     
        
    }

    
    /**
     *  @param  $userId     user id
     *  @return a record of a single user
     * 
     *  how to use: 
     *  
     *  use Helper;
     * 
     *  Helper::getUserDetails(123);    // get this user record
     */
    public static function getUserDetails($userId) {
        return Users::find($userId);
    }

    /**
     *  @param  $userRulesArray     array of users rules
     * 
     *  @return records of users of specific rules
     * 
     *  how to use: 
     * ------------
     *  example: in controller use the following... 
     * 
     *  use Helper;
     * 
     *  $arrayOfRules = [8, 9];
     *  Helper::getUsersBasedOnRules($arrayOfRules);    // get all users of type individual and company clients
     * 
     */
    public static function getUsersBasedOnRules($userRulesArray) {
        return Users::whereHas('rules', function($query) use($userRulesArray) {
            $query->whereIn('rule_id', $userRulesArray);
        })->get();
    }


    /**
     *  Used in casting string to dates
     * 
     *  @param  $dateStringed       raw input string    "01/02/2013"
     *  @param  $timeFormat         custom format       --optional value with standard value "Y-m-d 00:00:00"
     *  @return datetime value
     * 
     *  How to use:
     *  Helper::stringToDate("29/04/1994");
     */
    public static function stringToDate($dateStringed, $timeFormat="Y-m-d 00:00:00") {
        if($dateStringed) {
            return date($timeFormat, strtotime($dateStringed));
        } 
    }


    /**
     *  this helper function used in filter dates.
     *  date != null then transform from string to datetime, if not so, then replace its value with 1970... or 2030 depends on flag
     * 
     *  @param  $dateStringed       raw input string    "01/02/2013"
     *  @param  $flag               1 for 1970... and 2 for 2030...
     *  @param  $timeFormat         custom format       --optional value with standard value "Y-m-d 00:00:00"
     *  @return datetime value
     * 
     *  How to use:
     *  Helper::stringToDate("29/04/1994");
     */
    public static function checkDate($dateStringed, $flag, $timeFormat="Y-m-d 00:00:00") {
        if($dateStringed) {
            return date($timeFormat, strtotime($dateStringed));
        } else {
            if($flag == 1) {
                return  '1970-01-01 00:00:00';
            } else if($flag == 2) {
                return '2030-01-01 00:00:00';
            }
        }
    } 

    public static function percent($part, $all) {
        // return round( ($part * 100) / $all );
        return round(($part/$all)*100, 1);
    }

    public static function countCases($case_type_id, $city_id, $gov_id) {
        return Case_::where('case_type_id', $case_type_id)->where('geo_governorate_id', $gov_id)->where('geo_city_id', $city_id)->count();
    }

    public static function countCourts($courtId, $cityId, $govId) {
        return Case_::where('court_id', $courtId)->where('geo_city_id', $cityId)->where('geo_governorate_id', $govId)->count();
    }
    // TODO: add conditions about city and governorate
    public static function countTasks($clientId, $taskType=[1, 2, 3]) {
        return Tasks::where('client_id', $clientId)->whereIn('task_type_id', $taskType)->count();
    }

    public static function countCaseType($taskId) {
        return Case_::where('case_type_id', $taskId)->count();
    }

    public static function getUrgents($userRulesArray) {
        return Users::whereHas('rules', function($query) use($userRulesArray) {
            $query->whereIn('rule_id', $userRulesArray);
            })->whereHas('tasks', function($m) {
                $m->where('task_type_id', 1);
        })->get();
    }

    public static function mail($email ,$body ){
        Mail::raw('New Feedback   is ('.$body.' )', function($msg) use($email){ 
            $msg->to([$email])->subject('SecureBridge'); 
            $msg->from(['info@avocatoapp.net']); 

          });
    }

    public static function add_log($action_id , $entity_id , $item_id)
    {
        Log::create([
            'action_id'=>$action_id,
            'entity_id'=>$entity_id,
            'item_id'=>$item_id,
            'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
        	'created_by'=>\Auth::user()->id
        ]);
    }

    public static function is_dataentry_customer($id)
    {
       $user=Users::find($id);
       foreach($user->rules as $rule)
       {
        // dd($rule->id);
           if($rule->id == 3 || $rule->id == 4)
           {
               
               return true;
           }
       }
       return false;
    }
    public static function is_admin_superadmin($id)
    {
       $user=Users::find($id);
       foreach($user->rules as $rule)
       {
           if($rule->id == 1 || $rule->id == 2)
           {
               return true;
           }
       }
       return false;
    }
}