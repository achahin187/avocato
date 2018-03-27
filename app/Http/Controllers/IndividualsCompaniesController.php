<?php

namespace App\Http\Controllers;

use Helper;
use Session;
use Exception;

use App\Package_Types;
use App\Users;
use App\Geo_Countries;
use App\Entity_Localizations;
use App\User_Company_Details;
use App\Users_Rules;
use App\ClientsPasswords;
use App\User_Details;
use App\Subscriptions;
use App\Installment;
use Illuminate\Http\Request;

class IndividualsCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.individuals_companies.individuals_companies')->with('ind_coms', Users::users(10)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // custom helper function to generate a random number and check if this random number exists on a specific table
        $code  = Helper::generateRandom(Users::class, 'code', 6);
        
        $password = rand(10000000, 99999999);
        $subscription_types = Package_Types::all();

        $geo = Geo_Countries::all()->toArray();    // get all countries and cast it from object to array
        // get all ids in one array
        for($i=0; $i < count($geo); $i++) {
            $ids[] = $geo[$i]['id'];
        }
        $nationalities = Entity_Localizations::whereIn('item_id', $ids)->where('lang_id', 1)->get();  // select only arabic nationalities
        
        $companies = Users::users(9)->get();

        return view('clients.individuals_companies.individuals_companies_create', compact(['code', 'password', 'subscription_types', 'nationalities', 'companies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'password' => 'required',
            'name'  => 'required',
            'nationality' => 'required',
            'commercial_registration_number' => 'required',
            'fax'   => 'required',
            'website'   => 'required',
            'legal_representative_name' => 'required',
            'address'   => 'required',
            'phone' => 'required',
            'mobile'    => 'required',
            'email' => 'required|email',
            'work_sector' =>'required',
            'legal_representative_mobile' => 'required',
            'logo'=> 'image|mimes:jpeg,jpg,png',
            'discount_percentage' => 'required',
            'start_date'    => 'required',
            'end_date'  => 'required',
            'package_type_id' => 'required',
            'subscription_duration' => 'required',
            'subscription_value' => 'required',
            'number_of_payments' => 'required'
        ]);

        // upload image to storage/app/public
        if($request->logo) {
            $img = $request->logo;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('storage/app/public/companies', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/companies/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = null;
        }

        // INSERT COMPANY DATA
        // push into users
        try {
            $user = new Users();
            $user->name      = $request->name;
            $user->password  = $request->password;
            $user->full_name = $request->name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->mobile    = $request->mobile;
            $user->address   = $request->address;
            $user->birthdate  = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= 1;
            $user->save();
        } catch(\Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // Add Code to company
        try {
            $user->code = $user->id;
            $user->save();
        } catch (\Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', 'خطأ في كود الشركة');
            return redirect()->back()->withInput();
        }
        
        // push into users_rules
        try {
            $user_rules = new Users_Rules;
            $user_rules->user_id   = $user->id;
            $user_rules->rule_id   = 9;
            $user_rules->save();
        
        } catch(\Exception $ex) {
            $users_rules->forcedelete();
            Session::flash('warning', 'حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا #2');
            return redirect()->back()->withInput();
        }

        // push into client_passwords
        try {
            $client_passwords = new ClientsPasswords;
            $client_passwords->user_id = $user->id;
            $client_passwords->password = $request->password;
            $client_passwords->confirmation = 0;
            $client_passwords->save();
        } catch(\Exception $ex) {
            $user->forcedelete();
            $user_rules->forcedelete();

            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // TODO: national_id missing
        // push into users_details
        try {
            $user_details = new User_Details;
            
            $user_details->user_id       = $user->id;
            $user_details->country_id    = $request->nationality;
            $user_details->gender_id     = $request->gender_id;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work;
            $user_details->work_sector_type      = $request->work_type;
            $user_details->discount_percentage   = $request->discount_rate;
            $user_details->save();
        } catch(\Exception $ex) {
            $user->forcedelete();
            $user_rules->forcedelete();
            $client_passwords->forcedelete();
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
            $subscription = new Subscriptions;
            $subscription->user_id    = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date   = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->package_type_id   = $request->package_type_id;
            $subscription->duration = $request->subscription_duration;
            $subscription->value     = $request->subscription_value;
            $subscription->number_of_installments    = $request->number_of_payments;
            $subscription->save();
        } catch(\Exception $ex) {
            $user->forcedelete();
            $user_rules->forcedelete();
            $client_passwords->forcedelete();
            $user_details->forcedelete();
            
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into user_company_detail
        try {
            User_Company_Details::create([
                'user_id'   => $user->id,
                'commercial_registration_number' => $request->commercial_registration_number,
                'fax'     => $request->fax,
                'website' => $request->website,
                'legal_representative_name'      => $request->legal_representative_name,
                'legal_representative_mobile'    => $request->legal_representative_mobile
            ]);
        } catch(\Exception $ex) {
            
            Users::destroy($user->id);
            Users_Rules::where('user_id', $user->id)->delete();
            ClientsPasswords::where('user_id', $user->id)->delete();
            User_Details::where('user_id', $user->id)->delete();
            Subscriptions::destroy($subscription->id);
            Installment::where('subscription_id', $subscription->id)->delete();

            Session::flash('warning', '7 حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجدد');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('clients.individuals_companies.individuals_companies_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('clients.individuals_companies.individuals_companies_edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
