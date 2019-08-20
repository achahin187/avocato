<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'news';
    protected $fillable = ['name', 'body', 'photo', 'is_active', 'published_at', 'created_by', 'modified_by','photo_name','extension'];
    protected $hidden = ['id', 'created_at', 'updated_at'];
    public $timestamps = true;
}
