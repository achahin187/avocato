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
use App\User_Company_Details;
use Helper;
use Validator;

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
        return redirect()->route('landing')->with('success','تم إضافه عميل جديد بنجاح');
    }




        public function lawyer(Request $request)
    {
                // Validate data
		$validator = Validator::make($request->all(), [
		            'lawyer_name'=>'required',
		            'address'=>'required',
		            'nationality'=>'required',
		            'national_id'=>'required|numeric',
		            'birthdate'=>'required',
		            'phone'=>'required|numeric',
		            'mobile'=>'required|numeric',
		            'email'=>'required|email|max:40',
		        ]);

		        if ($validator->fails()) {
		            return redirect('Landing#tabBody1')
		            ->withErrors($validator)
		            ->withInput();
		        }

        $lawyer = new Users;
        $lawyer->name = $request->lawyer_name;
        $lawyer->full_name = $request->lawyer_name;
        $lawyer->address = $request->address;
        $lawyer->phone = $request->phone;
        $lawyer->mobile = $request->mobile;
        $lawyer->email = $request->email;
        $lawyer->is_active = 0;
        $lawyer->birthdate =date('Y-m-d H:i:s',strtotime($request->birthdate)); 
        $password = Helper::generateRandom(Users::class, 'password', 8);
        $lawyer->password = bcrypt($password);
        $lawyer->code = Helper::generateRandom(Users::class, 'code', 6);
        $lawyer->save();
        $lawyer->rules()->attach(5);

        $lawyer_details = new User_Details;
        $lawyer_details->national_id = $request->national_id;
        $lawyer_details->nationality_id = $request->nationality;
        $lawyer_plaintext = new ClientsPasswords;
        $lawyer_plaintext->password = $password;
        $lawyer->user_detail()->save($lawyer_details);
        $lawyer->client_password()->save($lawyer_plaintext);
        return redirect()->route('landing')->with('success','تم إضافه محامى جديد بنجاح');
    }


            public function company(Request $request)
    {
                // Validate data
		$validator = Validator::make($request->all(), [
		            'company_name'=>'required',
		            'address'=>'required',
		            'phone'=>'required|numeric',
		            'mobile'=>'required|numeric',
		            'email'=>'required|email|max:40',
		            'legal_representative_name'=>'required',
		        ]);

		        if ($validator->fails()) {
		            return redirect('Landing#tabBody2')
		            ->withErrors($validator)
		            ->withInput();
		        }

        $company = new Users;
        $company->name = $request->company_name;
        $company->full_name = $request->company_name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        $company->mobile = $request->mobile;
        $company->email = $request->email;
        $company->is_active = 0; 
        $password = Helper::generateRandom(Users::class, 'password', 8);
        $company->password = bcrypt($password);
        $company->code = Helper::generateRandom(Users::class, 'code', 6);
        $company->save();
        $company->rules()->attach([6,9]);

        $company_sub = new Subscriptions;
        $company->subscription()->save($company_sub);
        $company_install = new Installment ;
        $company_sub->installments()->save($company_install);

        $company_details = new User_Details;
        $user_company_details = new User_Company_Details;
        $user_company_details->legal_representative_name = $request->legal_representative_name;
        $company_plaintext = new ClientsPasswords;
        $company_plaintext->password = $password;
        $company->user_detail()->save($company_details);
        $company->user_company_detail()->save($user_company_details);
        $company->client_password()->save($company_plaintext);
        return redirect()->route('landing')->with('success','تم إضافه مكتب جديد بنجاح');
    }
}
