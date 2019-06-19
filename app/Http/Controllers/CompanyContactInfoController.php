<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\company_contact_info;
use App\company_social_media;
use App\Entity_Localizations;
use App\Entities;
use App\Helpers\Helper;
class CompanyContactInfoController extends Controller
{
    public function index(Request $request){
        
        $onload_data=company_contact_info::first();
        $social_accounts=company_social_media::all();
       
      //  dd($form_data->id);
    if($request->method()=='POST'){
 
      if($onload_data||true){

        $form_data=$onload_data;
      }else{
          $form_data=new company_contact_info();
      }
        // dd($form_data);
      //form input
      $form_data->email=$request->email;
      
      $form_data->mobile=$request->mobile;

      
     if($request->lang_id == '2'){
      $form_data->address=$request->address;
     }
      if(isset($request->lng) && isset($request->lng)){
      $form_data->longitude=$request->lng;
      
      $form_data->latitude=$request->lat;
    }

      $form_data->android_app_url=$request->android_link;
      
      $form_data->apple_app_url=$request->apple_link;

      // dd($form_data);
      if($form_data->save()){   
         if($request->lang_id !='2'){
          
           //set lang

          $localization =Helper::edit_entity_localization('company_contact_info', 'address', $form_data->id, $request->lang_id,$request->address);
         }
       
       
        return redirect ('contact_us');  
                    
      }

    }
       return view('contact_us',array('data'=>$onload_data, 'social_accounts'=>$social_accounts));
      

    }

    public function addSocialAccount(Request $request){
          
      if (isset($request->social_data)){
          
        $social_data=$request->social_data;
      
      $social_account=new company_social_media(); 
      
      $social_account->url=$social_data['website_link'];
      $social_account->icon=$social_data['icon_code'];
        
       if($social_account->save()){
        return response()->json(['success']);
       }    

      }
      return response()->json(['error']);
    }
    public function deleteSocialAccount(Request $request){

      if(isset($request->id)){
        $social_account= company_social_media::where('id',$request->id)->first();
        if($social_account->delete()){
          return response()->json(['success']);
        }

      }
      return response()->json(['error']);
    }
    
    
    public function getLocalization(Request $request){
      if(isset($request->selected_lang)){
           $lang_id=$request->selected_lang;
           
          if($lang_id != '2'){
          
            $form_data=company_contact_info::first();
            $address= Helper::localizations('company_contact_info','address',$form_data->id,$lang_id); 
           
          }else{
            $address=company_contact_info::first()->address;

          }
          return response()->json(['success'=>'success','address'=>$address]);
      }
      return response()->json(['error']);
    }

}
