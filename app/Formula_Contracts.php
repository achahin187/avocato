<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formula_Contracts extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'formula_contracts';
    public $timestamps = true;

        public function sub()
    {
        return $this->belongsTo('App\Formula_Contract_Types','formula_contract_types_id');
    }
}
