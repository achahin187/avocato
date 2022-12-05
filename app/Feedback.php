<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'feedbacks';
    protected $fillable = ['user_id', 'name', 'mobile', 'email', 'body', 'is_replied'];
    protected $dates = ['created_at'];
    public $timestamps = true;
    
    // Relations

     public function user()
    {
        return $this->belongsTo('App\Users','user_id');
    }

    public function feedbackReplies() {
        return $this->hasMany('App\FeedbackReply', 'feedback_id');
    }
}
