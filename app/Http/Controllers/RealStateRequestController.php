<?php

namespace App\Http\Controllers;

use App\RealStateRequest;

class RealStateRequestController extends Controller
{

    public function index()
    {
        $requests = RealStateRequest::paginate(20);
        return view('real_state_registration_requests.index',compact('requests'));
    }
}
