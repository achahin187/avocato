<?php 

namespace App\Helpers;
use Illuminate\Database\Eloquent\Model;
use App\Entities;

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
}