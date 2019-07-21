<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use Session;
use Validator;
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
use App\Case_Client;
use App\Tasks;
use App\Procurations;
use App\Helpers\VodafoneSMS;

use Illuminate\Http\Request;
use App\Bouquet;
use App\BouquetPaymentMethod;
use App\BouquetMethod;
use App\BouquetPrice;
use App\BouquetService;
use App\BouquetServiceCount;
use App\UserBouquet;
use App\UserBouquetPayment;
use App\UserBouquetServiceCount;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Bouquet::where('bouquet_type',1)->get();
        $subscriptions = Subscriptions::all();
        $nationalities = Geo_Countries::all();
        
        return view('clients.companies.companies', compact(['packages', 'subscriptions', 'nationalities']))->with('companies', Users::users(9)->where('country_id',Auth::user()->country_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ids = array();
        
        $password = rand(10000000, 99999999);
        $bouquets = Bouquet::where('bouquet_type',1)->with('payment')->with('price_relation')->get();

        $nationalities = Geo_Countries::all();
        // $packages = Package_Types::all();
        

        return view('clients.companies.companies_create', compact(['password', 'bouquets', 'nationalities']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all())
        // Validate data
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'name'  => 'required',
            'nationality' => 'required',
            'commercial_registration_number' => 'required',
            'legal_representative_name' => 'required',
            'address'   => 'required',
            'phone' => 'required',
            'tele_code'=>'required',
            'cellphone' => (session('country') == 1)?'required|digits:10|unique:users,cellphone,,,deleted_at,NULL':'required|digits:9|unique:users,cellphone,,,deleted_at,NULL',
            'email' => 'required|email',
            'work_sector' =>'required',
            'legal_representative_mobile' => 'required',
            'logo'=> 'image|mimes:jpeg,jpg,png',
            'start_date'    => 'required',
            'end_date'  => 'required',
            'bouquet_id' => 'required',
            'duration' => 'required',
            'value' => 'required',
            'number_of_installments' => 'required',
            'payment_method'      => 'required',
            'price_method'      => 'required',

        ]);
       
        if ($validator->fails()) {

            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
        // upload image to storage/app/public
        if($request->logo) {
            $img = $request->logo;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('users_images', $newImg);      // move to users_images
            $imgPath = 'users_images/'.$newImg;       // new path: users_images/imageName
        } else {
            $imgPath = 'users_images/male.jgp';
        }

        // INSERT COMPANY DATA
        // push into users
        try {
            $user = new Users();
            $user->name      = $request->name;
            $user->password  = bcrypt($request->password);
            $user->full_name = $request->name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->tele_code = $request->tele_code ;
            $user->cellphone = $request->cellphone ;
            // $user->mobile = preg_replace("/0/", "+", $request->mobile, 1);
            $user->mobile = $request->tele_code. $request->cellphone;
            $user->address   = $request->address;
            $user->is_active = $request->activate;
            $user->country_id=session('country');
            $user->created_by= Auth::user()->id;
            $user->save();
        } catch(Exception $ex) {
            $user->forceDelete();
            Session::flash('warning', $ex);
            return redirect()->back()->withInput();
        }

        // Add Code to company
        try {
            $user->code = $user->id;
            $user->save();
        } catch (Exception $ex) {
            $user->forceDelete();
            Session::flash('warning', 'خطأ في كود الشركة');
            return redirect()->back()->withInput();
        }
        
        // push into users_rules
        try {
            $data = array(
                array('user_id' => $user->id, 'rule_id' => 6),
                array('user_id' => $user->id, 'rule_id' => 9)
            );

            Users_Rules::insert($data);
        } catch(Exception $ex) {
            Users_Rules::where('user_id', $user->id)->forceDelete();
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
        } catch(Exception $ex) {
            $user->forceDelete();
            $user->rules->forceDelete();

            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // TODO: national_id missing
        // push into users_details
        try {
            $user_details = new User_Details;
            
            $user_details->user_id          = $user->id;
            $user_details->country_id       = $request->nationality;
            $user_details->nationality_id   = $request->nationality;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work_sector;
            if(isset($request->discount_percentage)){

                $user_details->discount_percentage   = $request->discount_percentage;
            }
            $user_details->save();
        } catch(Exception $ex) {
            $user->forceDelete();
            $user->rules->forceDelete();
            $client_passwords->forceDelete();
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        
        // push into subscriptions
        // try {
            $subscription = new UserBouquet;
            $subscription->user_id = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->bouquet_id = $request->bouquet_id;
            $subscription->duration = $request->duration;
            $subscription->value = $request->value;
            $subscription->number_of_installments = $request->number_of_installments;
            $subscription->is_subscribed = 1;
            $subscription->payment_method_id = $request->payment_method;
            $subscription->is_active = 1;
            $subscription->bouquet_price_id = $request->price_method;
            $subscription->save();
        // } catch (\Exception $ex) {
        //     $user->forceDelete();
        //     // $user->rules->delete();
        //     $client_passwords->forceDelete();
        //     $user_details->forceDelete();
        //     Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
        //     return redirect()->back()->withInput();
        // }

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
        } catch(Exception $ex) {
          
            Users::find($user->id)->forceDelete();
            Session::flash('warning', '7 حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجدد');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if (isset($request->payment) && !empty($request->payment)) {
                if ($request->number_of_installments != count($request->payment)) {
                    $user->forceDelete();

                    Session::flash('warning', '  حدث خطأ عند ادخال بيانات العميل ، من فضلك تأكد من ان عدد الاقساط التي تم ادخالها مساوٍِِ لحقل عدد الاقساط');
                    return redirect()->back()->withInput();

                } else if ($request->number_of_installments != 0 && $request->number_of_installments == count($request->payment)) {
                    $start_date = $request->start_date ;
                    for ($i = 0; $i < $request->number_of_installments; $i++) {
                        $pay_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date']));
                        if($request->payment_method == 1)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +1 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+1 month"));
                            
                        }
                        if($request->payment_method == 2)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +4 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+4 month"));
                            
                        }
                        if($request->payment_method == 3)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +6 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+6 month"));
                            
                        }
                        if($request->payment_method == 4)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +12 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+12 month"));
                            
                        }
                        // dd($end_date)
                        UserBouquetPayment::create([
                            'user_id' => $user->id,
                            'bouquet_id'=>$request->bouquet_id,
                            'payment_method'=>$request->payment_method,
                            'period' => $i + 1,
                            'price' => $request->payment[$i]['price'],
                            'actuall_start_date' => $pay_date,
                            'actuall_end_date' => $actuall_end_date,
                            'start_date'=>date('Y-m-d H:i:s', strtotime($start_date)),
                            'end_date' => $end_date ,
                            'payment_status' => $request->payment[$i]['payment_status'],
                        ]);

                        $start_date = $end_date;

                        if($request->payment[$i]['payment_status'] == 1)
                        {
                            $services = BouquetServiceCount::where('bouquet_id',$request->bouquet_id)->get();
                            foreach($services as $service)
                            {
                                if($service->service_active == 1)
                                {
                                    

                                  $user_service = UserBouquetServiceCount::where('user_id' , $user->id )->where('service_id',$service->bouquet_service_id)->first();
                                //   dd($user_service);
                                  if($user_service != null)
                                  {
                                    $count = $user_service->count + ($service->service_count / $request->number_of_installments);
                                    $user_service->update([
                                        'count'=>$count
                                    ]);
                                  }
                                  else
                                  {
                                    $count = $service->service_count / $request->number_of_installments ; 
                                    UserBouquetServiceCount::create([
                                        'user_id'=> $user->id ,
                                        'bouquet_id' => $request->bouquet_id ,
                                        'service_id' => $service->bouquet_service_id ,
                                        'all_count' => $service->service_count,
                                        'count'=>$count,
                                        
                                    ]);

                                  }
                                   

                                }
                                
                            }
                            
                        }
                    }
                }
            }
        } catch(Exception $ex) {
          
            $user->forceDelete();
            Users_Rules::where('user_id', $user->id)->forceDelete();
            $client_passwords->forceDelete();
            $user_details->forceDelete();
            // $subscription->forceDelete();

            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        try {

            $services = BouquetService::all();
            foreach ($services as $service)
            {
                $user_bouque = new UserBouquetServiceCount();
                $user_bouque->user_id = $user->id;
                $user_bouque->service_id = $service->id;
                $user_bouque->count = 1000000;
                $user_bouque->all_count = 1000000;
                $user_bouque->used = 0;
                $user_bouque->bouquet_id = 10;
                $user_bouque->save();
            }

          } catch (\Exception $e) {


          }

        // redirect with success
        $vodafone = new VodafoneSMS;
        $status =$vodafone::send($user->mobile,$user->code , $request->password);
        Session::flash('success', 'تم إضافة العميل بنجاح');
        return redirect('/companies');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user'] = Users::where('id',$id)->with('bouquets')->with('bouquet_services')->with('bouquet_payment')->first();

        // redirect to home page if user is not found
        if( $data['user'] == NULL ) {
            Session::flash('warning', 'المستخدم غير موجود');
            return redirect('/companies');
        }
        
        $data['packages'] = Entity_Localizations::where('field','name')->where('entity_id',1)->get();
        $data['cases'] = Case_Client::where('client_id', $id)->get();

        // get urgent
        $data['urgents'] =  Tasks::where('client_id', $id)->where('task_type_id', 1)->get();

        // get paid and free services only
        $data['services'] =  Tasks::where('client_id', $id)->where('task_type_id', 3)->get();
        $data['procurations'] = Procurations::where('client_id', $id)->get();
        return view('clients.companies.companies_show',$data);
    }

    public function comp_update(Request $request, $id)
    {
        $installment = Installment::find($id);
        $installment->is_paid = $request->installment;
        $installment->save();
        return redirect()->back();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Users::where('id',$id)->with('bouquets')->with('bouquet_services')->with('bouquet_payment')->first();

        // redirect to home page if user is not found
        if( $company == NULL ) {
            Session::flash('warning', 'المستخدم غير موجود');
            return redirect('/companies');
        }

        $password = $company->client_password ? ($company->client_password->password ? : 12345678) : 12345678;
        $bouquets = Bouquet::where('bouquet_type',1)->get();
        $nationalities = Geo_Countries::all();
        $installments = $company->bouquet_payment ? $company->bouquet_payment: 0;
        $payment_methods = ($company->bouquets()->count() != 0 ) ? BouquetMethod::where('bouquet_id',$comapny['bouquets'][0]['bouquet_id'])->with('payment')->get() : [];
        $price_methods = ($company->bouquets()->count() != 0 ) ? BouquetPrice::where('bouquet_id',$comapny['bouquets'][0]['id'])->get() : [];
            
        return view('clients.companies.companies_edit', compact(['company', 'password', 'subscription_types', 'nationalities', 'installments','bouquets','payment_methods','price_mehtods']));
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
        $user = Users::find($id);
        $validator = Validator::make($request->all(),[
            'company_code'  => 'required',  // users
            'password'      => 'required',  // usres - client_password
            'company_name'  => 'required',  // users
            'nationality'   => 'required',  // user_details
            'address'       => 'required',  // users
            'phone'         => 'required',  // users
            'tele_code'=>'required',
            'cellphone' => ($user->cellphone == $request['cellphone'])? "":((session('country')==1)?"unique:users,cellphone,,,deleted_at,NULL|digits:10":"unique:users,cellphone,,,deleted_at,NULL|digits:9"),
            // 'fax'           => 'required',  // user_company_details
            // 'website'       => 'required',  // user_company_details
            'work_sector'   => 'required',  // user_details
            'email'         => 'required',  // users
            'activate'      => 'required',  // users as is_active
            'start_date'    => 'required',  // subscription
            'end_date'      => 'required',  // subscription
            // 'logo'          => 'image|mimes:jpeg,jpg,png',  // users as image
            // 'bouquet_id'     => 'required',  // subscriptions as package_type_id
            // 'duration' => 'required',  // subscriptions as duration
            // 'value'    => 'required',  // subscriptions as value
            // 'number_of_installments'    => 'required',  // subscriptions as number_of_installments
            // 'discount_percentage'   => 'required',  // user_details
            'legal_representative_name'     => 'required',  // user_company_details
            'legal_representative_mobile'   => 'required',  // user_company_details
            'commercial_registration_number'    => 'required',  // user_company details
        ]);

        if ($validator->fails()) {
            return redirect()->back()
              ->withErrors($validator)
              ->withInput();
          }
        $user = Users::find($id);

        // upload image to storage/app/public
        if($request->logo) {
            $img = $request->logo;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('users_images', $newImg);      // move to /storage/app/public
            $imgPath = 'users_images/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = $user->image;
        }

        // INSERT COMPANY DATA
        // push into users
        try {
            
            $user->name      = $request->company_name;
            $user->password  = bcrypt($request->password);
            $user->full_name = $request->company_name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->tele_code = $request->tele_code ;
            $user->cellphone = $request->cellphone ;
            // $user->mobile = preg_replace("/0/", "+", $request->mobile, 1);
            $user->mobile = $request->tele_code . $request->cellphone;
            $user->address   = $request->address;
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->save();
        } catch(Exception $ex) {
          
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // push into client_passwords
        try {
            if(ClientsPasswords::where('user_id', $user->id)->first() != NULL) {
                $client_passwords = ClientsPasswords::where('user_id', $user->id)->first();
            } else {
                $client_passwords = new ClientsPasswords;
            }            
            
            $client_passwords->user_id = $user->id;
            $client_passwords->password = $request->password;
            $client_passwords->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // push into users_details
        try {
            if(User_Details::where('user_id', $user->id)->first() != NULL) {
                $user_details = User_Details::where('user_id', $user->id)->first();
            } else {
                $user_details = new User_Details;
            }

            $user_details->user_id       = $user->id;
            $user_details->country_id    = $request->nationality;
            $user_details->nationality_id= $request->nationality;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work_sector;
            $user_details->discount_percentage   = $request->discount_percentage;
            $user_details->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // convert user to individual by changing his/her user rule to 9
        try {
            $user_rule = Users_Rules::where('user_id', $user->id)->where('rule_id', '!=', 6)->first();
            $user_rule->rule_id = 9;
            $user_rule->save();
        } catch (Exception $ex) {
            Session::flash('warning', 'حدث خطأ عند تعديل بيانات العميل #8');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
            $subscription =  UserBouquet::where('user_id', $user->id)->first();
            if($subscription)
            {

            
            $subscription->update([
                'user_id' => $user->id,
                'start_date' => date('Y-m-d H:i:s', strtotime($request->start_date)),
                'end_date' => date('Y-m-d H:i:s', strtotime($request->end_date)),
                'bouquet_id' => $request->bouquet_id,
                'duration' => $request->duration,
                'value' => $request->value,
                'number_of_installments' => $request->number_of_installments,
                'is_subscribed' => 1,
                'payment_method_id' => $request->payment_method,
                'is_active' => 1,
            ]);
            }
            else
            {
                $subscription = new UserBouquet;
            $subscription->user_id = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->bouquet_id = $request->bouquet_id;
            $subscription->duration = $request->duration;
            $subscription->value = $request->value;
            $subscription->number_of_installments = $request->number_of_installments;
            $subscription->is_subscribed = 1;
            $subscription->payment_method_id = $request->payment_method;
            $subscription->is_active = 1;
            $subscription->price_method_id = $request->price_method;
            $subscription->save();
            }
           
            
        } catch (\Exception $ex) {
            // $user->forceDelete();
            // $user_rules->forceDelete();
            // $client_passwords->forceDelete();
            // $user_details->forceDelete();
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into user_company_detail
        try {
            // check if the user already has a relation with user_company_details table.
            if( User_Company_Details::where('user_id', $user->id)->first() ) {
                $ucd = User_Company_Details::where('user_id', $user->id)->first();
            } else {
                $ucd = new User_Company_Details;
            }
            
            $ucd->user_id   = $user->id;
            $ucd->commercial_registration_number = $request->commercial_registration_number;
             if(isset($request->fax)){

                 $ucd->fax     = $request->fax;
             }
            if(isset($request->website)){
            $ucd->website = $request->website;
        }
            $ucd->legal_representative_name      = $request->legal_representative_name;
            $ucd->legal_representative_mobile    = $request->legal_representative_mobile;
            $ucd->save();
        } catch(Exception $ex) {
           
            Session::flash('warning', '7 حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجدد');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if (isset($request->payment) && !empty($request->payment)) {
                if ($request->number_of_installments != count($request->payment)) {
                    $user->forceDelete();

                    Session::flash('warning', '  حدث خطأ عند ادخال بيانات العميل ، من فضلك تأكد من ان عدد الاقساط التي تم ادخالها مساوٍِِ لحقل عدد الاقساط');
                    return redirect()->back()->withInput();

                } else if ($request->number_of_installments != 0 && $request->number_of_installments == count($request->payment)) {
                    // dd($request->payment);
                    $start_date = $request->start_date ;
                    for ($i = 0; $i < $request->number_of_installments; $i++) {
                        $pay_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date']));
                        if($request->payment_method == 1)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +1 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+1 month"));
                            
                        }
                        if($request->payment_method == 2)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +4 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+4 month"));
                            
                        }
                        if($request->payment_method == 3)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +6 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+6 month"));
                            
                        }
                        if($request->payment_method == 4)
                        {
                            $end_date = date('Y-m-d', strtotime($start_date . " +12 month"));
                            $actuall_end_date = date('Y-m-d', strtotime($request->payment[$i]['actuall_start_date'] . "+12 month"));
                            
                        }
                        // dd($end_date)
                        $user_payment = UserBouquetPayment::where('user_id',$user->id)
                        ->where('bouquet_id',$request->bouquet_id)
                        ->where('payment_method',$request->payment_method)
                        ->where('period',$i+1)->first();
                        // dd($user_payment);
                        if($user_payment == null)
                        {
                            UserBouquetPayment::create([
                                'user_id' => $user->id,
                                'bouquet_id'=>$request->bouquet_id,
                                'payment_method'=>$request->payment_method,
                                'period' => $i + 1,
                                'price' => $request->payment[$i]['price'],
                                'actuall_start_date' => $pay_date,
                                'actuall_end_date' => $actuall_end_date,
                                'start_date'=>date('Y-m-d H:i:s', strtotime($start_date)),
                                'end_date' => $end_date ,
                                'payment_status' => $request->payment[$i]['payment_status']
                            ]);
                        }
                        else
                        {
                            $user_payment->update([
                                
                                'price' => $request->payment[$i]['price'],
                                'actuall_start_date' => $pay_date,
                                'actuall_end_date' => $actuall_end_date,
                                'start_date'=>date('Y-m-d H:i:s', strtotime($start_date)),
                                'end_date' => $end_date ,
                                'payment_status' => $request->payment[$i]['payment_status']
                            ]);
                        }
                        

                        $start_date = $end_date;

                        if($request->payment[$i]['payment_status'] == 1)
                        {
                            $services = BouquetServiceCount::where('bouquet_id',$request->bouquet_id)->get();
                            foreach($services as $service)
                            {
                                if($service->service_active == 1)
                                {
                                    

                                  $user_service = UserBouquetServiceCount::where('user_id' , $user->id )->where('service_id',$service->bouquet_service_id)->first();
                                //   dd($user_service);
                                  if($user_service != null)
                                  {
                                    $count = $user_service->count + ($service->service_count / $request->number_of_installments);
                                    $user_service->update([
                                        'count'=>$count
                                    ]);
                                  }
                                  else
                                  {
                                    $count = $service->service_count / $request->number_of_installments ; 
                                    UserBouquetServiceCount::create([
                                        'user_id'=> $user->id ,
                                        'bouquet_id' => $request->bouquet_id ,
                                        'service_id' => $service->bouquet_service_id ,
                                        'all_count' => $service->service_count,
                                        'count'=>$count,
                                        
                                    ]);

                                  }
                                   

                                }
                                
                            }
                            
                        }
                    }
                }
            }
        }catch(Exception $ex) {
            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // redirect with success
        Session::flash('success', 'تم تعديل العميل بنجاح');
        return redirect('/companies');
    }

    public function destroy($id)
    {
        // Find and delete this record
        Users::destroy($id);

        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function destroyShow($id)
    {
        // Find and delete this record
        Users::find($id)->delete();
        return redirect()->route('companies')->with('success','تم استبعاد العميل');
    }

    /**
     * Delete selected rows
     */
    public function destroySelected(Request $request) 
    {
        // get cities IDs from AJAX
        $ids = $request->ids;

        // transform $ids into array values then search and delete
        Users::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $data = array(['المدينة', 'المحافظة']);
        $ids = explode(",", $request->ids);
        // $data = Geo_Cities::whereIn('id', explode(",", $ids))->get();

        foreach($ids as $id) {
            $d =  Geo_Cities::find($id);
            array_push( $data, [$d->name, $d->governorate->name]);
        }

        $myFile = Excel::create('المدن والمحافظات', function($excel) use ($data) {
            $excel->setTitle('المدن والمحافظات');
            // Chain the setters
            $excel->setCreator('جسر الامان')
            ->setCompany('جسر الامان');
            // Call them separately
            $excel->setDescription('بيانات ما تم اختياره من جدول المحافظات والمدن');

            $excel->sheet('المدن والمحافظات', function($sheet) use ($data) {
                $sheet->setRightToLeft(true);
                $sheet->getStyle('A1:B1')->getFont()->setBold(true);
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        });

        $myFile = $myFile->string('xlsx');
        $response = array(
            'name' => 'المدن والمحافظات'.date('Y_m_d'),
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );

        return response()->json($response);
    }

    // Filter companies based on package_type, start-end dates and nationality
    public function filter(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'activate'  => 'required'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('companies#filterModal_sponsors')
                            ->withErrors($validator)
                            ->withInput();
        }

        $startfrom = Helper::checkDate($request->start_date_from, 1);
        $startto   = Helper::checkDate($request->start_date_to, 2);
        $endfrom   = Helper::checkDate($request->end_date_from, 1);
        $endto     = Helper::checkDate($request->end_date_to, 2);

        // intial join query between `users` & `subscriptions` & `user_details`
        $users = Users::users(9)->join('user_company_details', 'users.id', '=', 'user_company_details.user_id')
                        ->join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
                        ->join('user_details', 'users.id', '=', 'user_details.user_id')
                        ->select('user_company_details.*', 'user_details.*', 'subscriptions.*', 'users.*');

        // check package type
        if( $request->package_type ) {
            $users = $users->whereIn('package_type_id', $request->package_type);
        }

        // check on start and end dates
        if($startfrom && $startto && $endfrom && $endto) {
            $users = $users->whereBetween('start_date', [$startfrom, $startto]);
            $users = $users->whereBetween('end_date', [$endfrom, $endto]);
        }

        // check nationality
        if($request->nationality) {
            $users = $users->where('user_details.nationality_id', $request->nationality);
        }

        switch($request->activate) {
            case "1":
                $users = $users->get();
                break;
            case "2":
                $users = $users->where('users.is_active', '!=', 0)->get();
                break;
            case "3":
                $users = $users->where('users.is_active', '=', 0)->get();
                break;
            default:
                break;
        }
        

        $packages = Package_Types::all();
        $subscriptions = Subscriptions::all();
        $nationalities = Geo_Countries::all();

        return view('clients.companies.companies', compact(['packages', 'subscriptions', 'nationalities']))->with('filters', $users);
    }
}
