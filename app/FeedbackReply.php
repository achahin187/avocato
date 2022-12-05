<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackReply extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'feedback_replies';
    protected $fillable = ['feedback_id', 'reply', 'mobile', 'created_by'];
    protected $dates = ['created_at'];
    public $timestamps = true;
    
    // Relations

    public function feedback() {
        return $this->blongsTo('App\Feedback', 'feedback_id');
    }
}
