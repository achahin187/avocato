<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Geo_Countries;
use Session;

class GeoCountryController extends Controller
{
    public function index()
    {
        if(session('country') == null)
        {
            return redirect()->route('choose.country');
        }
        $data['countries']=Geo_Countries::all();
        return view('choose_country',$data);
    }

    public function choose(Request $request)
    {
        session()->regenerate();
        Session::put('country', $request['country'] );
        return redirect()->route('login');
    }
}
