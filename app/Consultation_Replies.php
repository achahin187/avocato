<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultation_Replies extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'consulation_replies';
    protected $fillable = ['reply','lawyer_id','is_perfect_answer'];
    protected $hidden = ['created_at', 'updated_at'];
    public $timestamps = true;
    public function consultation()
    {
    	return $this->belongsTo('App\Consultation','consultation_id')->withDefault();
    }
}
