<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Substitution extends Model
{
    protected $table ='substitution';
	protected $foriegn_key='task_id';
    protected $fillable = ['task_id','substitution_type_id','court','region' , 'requests' ,'decisions','notes' ,'date','client_name','client_character','client_lawyer','client_procuration','contender','contender_character'];

    protected $dates = ['date'];

    public static $rules = [
        // Validation rules
    ];
 	public $timestamps=false;
    // Relationships
     public function tasks()
    {
        return $this->belongsTo('App\Task','task_id');
    }

    public function type()
    {
        return $this->belongsTo('App\SubstitutionType','substitution_type_id');
    }
}
