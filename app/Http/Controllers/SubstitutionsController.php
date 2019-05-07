<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Substitution;
use App\SubstitutionType;

class SubstitutionsController extends Controller
{
    public function index()
    {
        $data['substitution_types']=SubstitutionType::all();
        $data['substitutions']=Taska::with(['substitution'=>function($q){
            $q->with('type');
        }])->get();

        return view('substitutions.index',$data);
    }
}
