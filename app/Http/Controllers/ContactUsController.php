<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_Branch;
use App\Contact_Detail;

class ContactUsController extends Controller
{
    public function index()
    {
        $data['branches']=Company_Branch::with('contact_detail')->get();
        // dd($data['branches']['0']['contact_detail'][0]['pivot']['name']);

      return view('contactus.index',$data);
    }
    
    public function create(Request $request)
    {
        dd($request);

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
    public function update(Request $request , $id)
    {

    }

    public function delete($id)
    {
        try{
            Company_Branch::destroy($id);
            Contact_Detail::where('company_branch_id',$id)->delete();
        }
        catch(\Exception $ex)
        {
          return redirect()->back()->with('error','error while deleteing Branch');
        }
        return redirect()->route('contactus_index');
    }
    public function destroy_all()
    {

        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            try{
                Company_Branch::destroy($id);
                Contact_Detail::where('company_branch_id',$id)->delete();
            }
            catch(\Exception $ex)
            {
              
            }
         

        }
        return redirect()->route('contactus_index');
    }

    public function contactUsAjax($lang_id , $id)
    {
        if($lang_id==2)
        {
            
        $en = Company_Branch::find($id);
        return $en['name'];
        }
        else{
        $other_lang = Helper::localizations('company_branches','name',$id,$lang_id);  
        return $other_lang;  
        }
    }
}
