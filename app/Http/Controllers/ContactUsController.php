<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_Branch;
use App\Contact_Detail;
use App\Geo_Countries;

class ContactUsController extends Controller
{
    public function index()
    {
        $data['branches']=Company_Branch::with('contact_detail')->get();
        $data['codes']=Geo_Countries::all();
        // dd($data['branches']['0']['contact_detail'][0]['pivot']['name']);

      return view('contactus.index',$data);
    }
    
    public function create(Request $request)
    {
        // dd($request->all());
        try{
            if($request->lang_id == 2)
            {
                $branch= Company_Branch::create($request->all());
            }
           
           if($request->lang_id !='2'){
          
            //set lang
            $branch= Company_Branch::create([
                'is_main'=>$request['is_main'],
                'longitude'=>$request['longitude'],
                'latitude'=>$request['latitude']
            ]);
           $localization_address =Helper::edit_entity_localization('company_branches', 'address', $branch->id, $request->lang_id,$request->address);
           $localization_name =Helper::edit_entity_localization('company_branches', 'name', $branch->id, $request->lang_id,$request->name);
          }
           if(isset($request['email']))
           {
               foreach($request['email'] as $email)
               {
                Contact_Detail::create([
                    'contact_detail_type'=>3,
                    'name'=>'email',
                    'value'=>$email,
                    'company_branch_id'=>$branch['id']
                ]);
               }
           }
           if(isset($request['mobile']))
           {
               foreach($request['mobile'] as $key => $mobile)
               {
                Contact_Detail::create([
                    'contact_detail_type'=>1,
                    'name'=>'mobile',
                    'code'=>$request['code'][$key],
                    'value'=>$mobile,
                    'company_branch_id'=>$branch['id']
                ]);
               }
           }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','cannot add this branch try again');
        }
        return redirect()->route('contactus_index')->with('success','branch added successfully');
    }
    public function add()
    {
        $data['codes']=Geo_Countries::all();
        return view('contactus.add' , $data);
    }

    public function edit($id)
    {
        $data['branch']=Company_Branch::where('id',$id)->with('contact_detail')->first();
        $data['codes']=Geo_Countries::all();
        return view('contactus.edit',$data);
    }
    public function update(Request $request , $id)
    {
        $branch = Company_Branch::find($id);
        if(! $branch)
        {
            return redirect()->back()->with('error','Not A Branch');
        }
        try{
            if($request->lang_id == 2)
            {
                $branch= Company_Branch::where('id',$id)->update($request->all());
            }
           
           if($request->lang_id !='2'){
          
            //set lang
            $branch= Company_Branch::where('id',$id)->update([
                'is_main'=>$request['is_main'],
                'longitude'=>$request['longitude'],
                'latitude'=>$request['latitude']
            ]);
           $localization_address =Helper::edit_entity_localization('company_branches', 'address', $branch->id, $request->lang_id,$request->address);
           $localization_name =Helper::edit_entity_localization('company_branches', 'name', $branch->id, $request->lang_id,$request->name);
          }
           if(isset($request['email']))
           {
            Contact_Detail::where('contact_detail_type',3)->where('company_branch_id',$branch['id'])->delete();
               foreach($request['email'] as $email)
               {
                Contact_Detail::create([
                    'contact_detail_type'=>3,
                    'name'=>'email',
                    'value'=>$email,
                    'company_branch_id'=>$branch['id']
                ]);
               }
           }
           if(isset($request['mobile']))
           {
            Contact_Detail::where('contact_detail_type',1)->where('company_branch_id',$branch['id'])->delete();
               foreach($request['mobile'] as $key => $mobile)
               {
                Contact_Detail::create([
                    'contact_detail_type'=>1,
                    'name'=>'mobile',
                    'code'=>$request['code'][$key],
                    'value'=>$mobile,
                    'company_branch_id'=>$branch['id']
                ]);
               }
           }
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error','cannot add this branch try again');
        }
        return redirect()->route('contactus_index')->with('success','branch edited successfully');
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

    public function getLocalization(Request $request){
        if(isset($request->selected_lang)){
             $lang_id=$request->selected_lang;
             
            if($lang_id != '2'){
            
              $form_data=Company_Branches::find($request['id']);
              $field= Helper::localizations('company_branches',$request['field'],$form_data->id,$lang_id); 
             
            }else{
              $field=Company_Branch::find($request['id'])->$request['field'];
  
            }
            return response()->json(['success'=>'success','field'=>$field]);
        }
        return response()->json(['error']);
      }
}
