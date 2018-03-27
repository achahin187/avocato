<?php

namespace App\Http\Controllers;

use Helper;
use Session;

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

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.companies.companies')->with('companies', Users::users(9)->get());
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

        $geo = Geo_Countries::all();    // get all countries
        $nationalities = Entity_Localizations::whereIn('item_id', $geo[0])->where('lang_id', 1)->get();  // select only arabic nationalities

        return view('clients.companies.companies_create', compact(['code', 'password', 'subscription_types', 'nationalities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate data
        $this->validate($request, [
            'code'  => 'required',
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

        // INSERT INDIVIDUAL DATA
        // push into users
        try {
            $user = Users::create([
                'name'      => $request->name,
                'password'  => $request->password,
                'full_name' => $request->name,
                'email'     => $request->email,
                'image'     => $imgPath,
                'phone'     => $request->phone,
                'mobile'    => $request->mobile,
                'address'   => $request->address,
                'code'      => $request->code,
                'is_active' => $request->activate,
                'created_by'=> 1
            ]);
        } catch(QueryException $ex) {
            
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // push into users_rules
        try {
            Users_Rules::create([
                'user_id'   => $user->id,
                'rule_id'   => 9
            ]);
        } catch(QueryException $ex) {
            
            Users::destroy($user->id);

            Session::flash('warning', 'حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا #2');
            return redirect()->back()->withInput();
        }

        // push into client_passwords
        try {
            ClientsPasswords::create([
                'user_id'   => $user->id,
                'password'  => $request->password,
                'confirmation'  => 0
            ]);
        } catch(QueryException $ex) {
            
            Users::destroy($user->id);
            Users_Rules::where('user_id', $user->id)->delete();

            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // TODO: national_id missing
        // push into users_details
        try {
            User_Details::create([
                'user_id'       => $user->id,
                'country_id'    => $request->nationality,
                'nationality_id'=> $request->nationality,
                'address'       => $request->address,
                'job_title'     => $request->job,
                'national_id'   => $request->national_id,
                'work_sector'   => $request->work_sector,
                'discount_percentage'   => $request->discount_percentage,
            ]);
        } catch(QueryException $ex) {
            
            Users::destroy($user->id);
            Users_Rules::where('user_id', $user->id)->delete();
            ClientsPasswords::where('user_id', $user->id)->delete();

            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
            $subscription = Subscriptions::create([
                'user_id'    => $user->id,
                'start_date' => date('Y-m-d H:i:s', strtotime($request->start_date)),
                'end_date'   => date('Y-m-d H:i:s', strtotime($request->end_date)),
                'package_type_id'   => $request->package_type_id,
                'duration' => $request->subscription_duration,
                'value'    => $request->subscription_value,
                'number_of_installments'    => $request->number_of_payments
            ]);
        } catch(QueryException $ex) {
            
            Users::destroy($user->id);
            Users_Rules::where('user_id', $user->id)->delete();
            ClientsPasswords::where('user_id', $user->id)->delete();
            User_Details::where('user_id', $user->id)->delete();

            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if($request->number_of_payments != 0) {
                for($i=0; $i < $request->number_of_payments; $i++) {
                    $pay_date = date('Y-m-d', strtotime($request->payment_date[$i]));
                    Installment::create([
                        'subscription_id'   => $subscription->id,
                        'installment_number'=> $i+1,
                        'value' => $request->payment[$i],
                        'payment_date'  => $pay_date,
                        'is_paid'   => 1 //$request->payment_status[i]
                    ]);
                }
            }
        } catch(QueryException $ex) {
            
            Users::destroy($user->id);
            Users_Rules::where('user_id', $user->id)->delete();
            ClientsPasswords::where('user_id', $user->id)->delete();
            User_Details::where('user_id', $user->id)->delete();
            Subscriptions::destroy($subscription->id);

            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
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
        } catch(QueryException $ex) {
            
            Users::destroy($user->id);
            Users_Rules::where('user_id', $user->id)->delete();
            ClientsPasswords::where('user_id', $user->id)->delete();
            User_Details::where('user_id', $user->id)->delete();
            Subscriptions::destroy($subscription->id);
            Installment::where('subscription_id', $subscription->id)->delete();

            Session::flash('warning', '7 حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجدد');
            return redirect()->back()->withInput();
        }

        // redirect with success
        Session::flash('success', 'تم إضافة العميل بنجاح');
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('clients.companies.companies_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('clients.companies.companies_edit');
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
