<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity_Localizations;
use App\Users;
use App\User_Details;
use App\ClientsPasswords;
use App\Subscriptions;
use App\Package_Types;
use App\Installment;
use App\Rules;
use App\Genders;
use App\Geo_Countries;
use App\User_Offices;
use Helper;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Helpers\TwilioSmsService;

class LandingController extends Controller
{
        public function index($lang)
    {
    	$data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
    	$data['genders'] = Entity_Localizations::where('field','name')->where('entity_id',2)->get();
        $data['genders_en'] = Genders::all();
        $data['nationalities_en'] = Geo_Countries::all();
        if($lang == 'ar')
        {
            return view('landing',$data);
        }
        elseif($lang == 'en')
        {
            return view('landing-en',$data);
        }
        else
        {
            return abort('404');
        }

        
    }

        public function ind(Request $request)
    {
        $url = url()->previous();
        $split = explode('/',$url);
        $lang = end($split);
        if($lang == 'en')
            \App::setlocale('en');
                // Validate data
        $this->validate($request, [
            'ind_name'  => 'required',
            'job'   => 'required',
            'address'   => 'required',
            'national_id'   => 'required|numeric',
            'birthdate'  => 'required',
            'nationality'   => 'required',
            'phone' => 'required|numeric',
            'mobile'    => 'required|numeric',
            'email' => 'required|email',
            'gender'=>'required',
        ]);

        $client = new Users;
        $client->name = $request->ind_name;
        $client->full_name = $request->ind_name;
        $client->address = $request->address;
        $client->phone = $request->phone;
        $client->mobile = $request->mobile;
        $client->email = $request->email;
        $client->is_active = 0;
        $client->birthdate =date('Y-m-d H:i:s',strtotime($request->birthdate)); 
        $password = Helper::generateRandom(Users::class, 'password', 8);
        $client->password = bcrypt($password);
        $client->code = Helper::generateRandom(Users::class, 'code', 6);
        $client->save();
        $client->rules()->attach([6,8]);

        $client_sub = new Subscriptions;
        $client->subscription()->save($client_sub);
        $client_install = new Installment ;
        $client_sub->installments()->save($client_install);

        $client_details = new User_Details;
        $client_details->gender_id = $request->gender;
        $client_details->job_title = $request->job;
        $client_details->national_id = $request->national_id;
        $client_details->nationality_id = $request->nationality;
        $client_plaintext = new ClientsPasswords;
        $client_plaintext->password = $password;
        $client->user_detail()->save($client_details);
        $client->client_password()->save($client_plaintext);
    if($lang == 'en')
        return redirect()->route('landing','en')->with('success','New Client Successfully Registered ');
    else
        return redirect()->route('landing','ar')->with('success','تم إضافه عميل جديد بنجاح');
            
    }




        public function lawyer(Request $request)
    {
        // dd($request->all());
        $twilio_config = [
            'app_id' => 'AC2305889581179ad67b9d34540be8ecc1',
            'token'  => '2021c86af33bd8f3b69394a5059c34f0',
            'from'   => '+13238701693'
         ];

         $twilio = new TwilioSmsService($twilio_config);
        $url = url()->previous();
        $split = explode('/',$url);
        $lang = end($split);
        if($lang == 'en')
            \App::setlocale('en');
                // Validate data
		$validator = Validator::make($request->all(), [
		            'lawyer_name'=>'required',
		            'address'=>'required',
		            'nationality'=>'required',
		            'national_id'=>'required|numeric',
		            'birthdate'=>'required',
		            'phone'=>'required|numeric',
		            'mobile'=>"required|unique:users|regex:/^\+?[^a-zA-Z]{5,}$/|min:11|max:11",
		            'email'=>"required|bail|email",
		        ]);

		        if ($validator->fails()) {
		            return redirect()->back()
		            ->withErrors($validator)
		            ->withInput();
		        }

        $lawyer = new Users;
        $lawyer->name = $request->lawyer_name;
        $lawyer->full_name = $request->lawyer_name;
        $lawyer->address = $request->address;
        $lawyer->phone = $request->phone;
        $lawyer->mobile = '+2'.$request->mobile;
        $lawyer->email = $request->email;
        $lawyer->is_active = 0;
        $lawyer->birthdate =date('Y-m-d H:i:s',strtotime($request->birthdate)); 
        $password = Helper::generateRandom(Users::class, 'password', 8);
        $lawyer->password = bcrypt($password);
        $lawyer->code = Helper::generateRandom(Users::class, 'code', 6);
        $lawyer->verificaition_code = str_random(4);
         $lawyer->is_verification_code_expired=0;
        $lawyer->save();
        $lawyer->rules()->attach([5,14]);

        $lawyer_details = new User_Details;
        $lawyer_details->national_id = $request->national_id;
        $lawyer_details->nationality_id = $request->nationality;
        $lawyer_plaintext = new ClientsPasswords;
        $lawyer_plaintext->password = $password;
        $lawyer->user_detail()->save($lawyer_details);
        $lawyer->client_password()->save($lawyer_plaintext);
         $status =$twilio->send($lawyer->mobile,$lawyer->verificaition_code);
         
          $mail=Helper::mail_register($lawyer->email,$lawyer->code,$lawyer->verificaition_code);
// dd($status);
    if($lang == 'en')
        return redirect()->route('landing','en')->with('success','New Lawyer Successfully Registered ');
    else
        return redirect()->route('landing','ar')->with('success','تم إضافه محامى جديد بنجاح');
    }


            public function office(Request $request)
    {
        $url = url()->previous();
        $split = explode('/',$url);
        $lang = end($split);
        if($lang == 'en')
            \App::setlocale('en');
                // Validate data
		$validator = Validator::make($request->all(), [
		            'office_name'=>'required',
		            'address'=>'required',
		            'phone'=>'required|numeric',
		            'mobile'=>'required|numeric',
		            'email'=>'required|email|max:40',
		            'legal_representative_name'=>'required',
                    'image'=>'image|mimes:jpeg,jpg,png|max:1024',
		        ]);

		        if ($validator->fails()) {
		            return redirect()->back()
		            ->withErrors($validator)
		            ->withInput();
		        }

                if($request->hasFile('image')){
                    $destinationPath='logos';
                    $fileNameToStore=$destinationPath.'/'.$request->office_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            // dd($fileNameToStore);
                    Input::file('image')->move($destinationPath,$fileNameToStore);
                }

        $office = new Users;
        $office->name = $request->legal_representative_name;
        $office->full_name = $request->legal_representative_name;
        $office->address = $request->address;
        $office->phone = $request->phone;
        $office->mobile = $request->mobile;
        $office->email = $request->email;
        $office->is_active = 0; 
        $password = Helper::generateRandom(Users::class, 'password', 8);
        $office->password = bcrypt($password);
        $office->code = Helper::generateRandom(Users::class, 'code', 6);
        $office->save();
        $office->rules()->attach([5,14]);

        $user_offices = new User_Offices;
        $user_offices->name = $request->office_name;
        $user_offices->logo = $fileNameToStore;
        $office->offices()->save($user_offices);

        // $office_sub = new Subscriptions;
        // $office->subscription()->save($office_sub);
        // $office_install = new Installment ;
        // $office_sub->installments()->save($office_install);

        $office_details = new User_Details;
        $office_plaintext = new ClientsPasswords;
        $office_plaintext->password = $password;
        $office->user_detail()->save($office_details);
        $office->client_password()->save($office_plaintext);

    if($lang == 'en')
        return redirect()->route('landing','en')->with('success','New office Successfully Registered ');
    elseif($lang == 'ar')
        return redirect()->route('landing','ar')->with('success','تم إضافه مكتب جديد بنجاح');
    }
}
