<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Formula_Contract_Types extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'formula_contract_types';
    public $timestamps = true;
        public function parent()
    {
        return $this->belongsTo('App\Formula_Contract_Types', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Formula_Contract_Types', 'parent_id');
    }
}
