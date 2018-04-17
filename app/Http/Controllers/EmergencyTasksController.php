<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
class EmergencyTasksController extends Controller
{
    public function view($id)
    {
    	$data['task']=Tasks::find($id);
    	return view('tasks.emergency_view',$data);
    }
}
