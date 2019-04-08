<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_Branch;
use App\Contact_Detail;

class ContactUsController extends Controller
{
    public function index()
    {
        $data['branches']=Company_Branch::all();

      return view('contactus.index',$data);
    }
    
    public function create()
    {

    }
    public function add()
    {
        return view('contactus.add');
    }

    public function edit($id)
    {
        $data['branch']=Company_Branch::where('id',$id)->with('contact_detail')->first();
        return view('contactus.edit',$data);
    }
    public function update()
    {

    }
}
