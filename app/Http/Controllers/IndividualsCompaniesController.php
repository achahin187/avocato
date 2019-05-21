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

class IndividualsCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(session('country') == null)
        // {
        //     return redirect()->route('choose.country');
        // }
        $packages = Bouquet::all();
        $subscriptions = Subscriptions::all();
        $nationalities = Geo_Countries::all();
        $companies     = Users::users(9)->get();
        return view('clients.individuals_companies.individuals_companies', compact(['packages', 'subscriptions', 'nationalities', 'companies']))->with('ind_coms', Users::users(10)->where('country_id',Auth::user()->country_id)->get());
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
        $bouquets = Bouquet::with('payment')->with('price_relation')->get();
        $nationalities = Geo_Countries::all();        
        $companies = Users::users(9)->get();

        return view('clients.individuals_companies.individuals_companies_create', compact(['code', 'password', 'bouquets', 'nationalities', 'companies']));
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
            'company_code'  => 'required',
            'company_name'  => 'required',
            'ind_name'      => 'required',
            'gender'        => 'required',
            'job'           => 'required',
            'address'       => 'required',
            'national_id'   => 'required',
            'nationality'   => 'required',
            'birthday'      => 'required|date',
            'phone'         => 'required',
            'tele_code'=>'required',
            'cellphone' => (session('country') == 1)?'required|digits:10|unique:users,cellphone,,,deleted_at,NULL':'required|digits:9|unique:users,cellphone,,,deleted_at,NULL',
            'email'         => 'required',
            'discount_percentage' => 'required',
            'activate'      => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            'package_type_id'=> 'required',
            'duration'      => 'required',
            'value'         => 'required',
            'number_of_payments' => 'required'
        ]);

        // upload image to storage/app/public
        if($request->logo) {
            $img = $request->logo;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('users_images', $newImg);      // move to users_images
            $imgPath = 'users_images/'.$newImg;       // new path: users_images/imageName
        } else {
            // if user didn't pick an image and he choose male then assign male.jpg as his image.
            if ( $request->gender == 1 ) {
                $imgPath = 'users_images/male.jpg';
            } else {
                // else assign female.jpg as her image.
                $imgPath = 'users_images/female.jpg';
            }
        }

        // INSERT COMPANY DATA
        // push into users
        try {
            $user = new Users();
            $user->parent_id = $request->company_code;
            $user->name      = $request->ind_name;
            $user->password  = bcrypt($request->password);
            $user->full_name = $request->ind_name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->tele_code = $request->tele_code ;
            $user->cellphone = $request->cellphone ;
            // $user->mobile = preg_replace("/0/", "+", $request->mobile, 1);
            $user->mobile = $request->tele_code . $request->cellphone;
            $user->address   = $request->address;
            $user->birthdate = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->country_id=session('country');
            $user->save();
        } catch(Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', $ex);
            return redirect()->back()->withInput();
        }

        // Add Code to company
        try {
            $user->code = $user->id;
            $user->save();
        } catch (Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', 'خطأ في كود الشركة');
            return redirect()->back()->withInput();
        }
        
        // push into users_rules
        try {
            $data = array(
                array('user_id' => $user->id, 'rule_id' => 6),
                array('user_id' => $user->id, 'rule_id' => 10)
            );

            Users_Rules::insert($data);
        } catch(Exception $ex) {
            Users_Rules::where('user_id', $user->id)->forcedelete();
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
            $user_details->nationality_id = $request->nationality;
            $user_details->gender_id     = $request->gender;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work;
            $user_details->work_sector_type      = $request->work_type;
            $user_details->discount_percentage   = $request->discount_percentage;
            $user_details->save();
        } catch(Exception $ex) {
            $user->forcedelete();
            $user_rules->forcedelete();
            $client_passwords->forcedelete();
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
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
        } catch (\Exception $ex) {
            $user->forcedelete();
            $user_rules->forcedelete();
            $client_passwords->forcedelete();
            $user_details->forcedelete();
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if (isset($request->payment) && !empty($request->payment)) {
                if ($request->number_of_installments != count($request->payment)) {
                    $user->forcedelete();

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
                            'start_date'=>$start_date,
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
            dd($ex);
            $user->forcedelete();
            $user_rules->forcedelete();
            $client_passwords->forcedelete();
            $user_details->forcedelete();
            $subscription->forcedelete();

            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // redirect with success
        $vodafone = new VodafoneSMS;
        $status =$vodafone::send($user->mobile,$user->code , $request->password);
        Session::flash('success', 'تم إضافة العميل بنجاح');
        return redirect('/individuals_companies');
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
            return redirect('/individuals_companies');
        }
        
        $data['packages'] = Entity_Localizations::where('field','name')->where('entity_id',1)->get();
        $data['cases'] = Case_Client::where('client_id', $id)->get();

        // get urgent
        $data['urgents'] =  Tasks::where('client_id', $id)->where('task_type_id', 1)->get();

        // get paid and free services only
        $data['services'] =  Tasks::where('client_id', $id)->where('task_type_id', 3)->get();

         $data['procurations'] = Procurations::where('client_id', $id)->get();

        return view('clients.individuals_companies.individuals_companies_show',$data);
    }

    public function ind_comp_update(Request $request, $id)
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
        $user = Users::where('id',$id)->with('bouquets')->with('bouquet_services')->with('bouquet_payment')->first();

        // redirect to home page if user is not found
        if( $user == NULL ) {
            Session::flash('warning', 'المستخدم غير موجود');
            return redirect('/individuals_companies');
        }

        $password = $user->client_password ? ($user->client_password->password ? : 12345678) : 12345678;
        $bouquets = Bouquet::all();
        $nationalities = Geo_Countries::all();  
        $installments = $user->bouquet_payment ? $user->bouquet_payment: 0;
        $payment_methods = ($user->bouquets()->count() != 0  ) ? BouquetMethod::where('bouquet_id',$user['bouquets'][0]['bouquet_id'])->with('payment')->get() : [];
        $price_methods = ($user->bouquets()->count() != 0 ) ? BouquetPrice::where('bouquet_id',$user['bouquets'][0]['bouquet_id'])->get() : [];
        $companies = Users::users(9)->get();

        return view('clients.individuals_companies.individuals_companies_edit', compact(['user', 'password', 'bouquets', 'nationalities', 'installments', 'companies' ,'payment_methods','price_methods']) );
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

        $this->validate($request, [
            'company_code'  => 'required',
            'company_name'  => 'required',
            'ind_name'      => 'required',
            'gender'        => 'required',
            'job'           => 'required',
            'address'       => 'required',
            'national_id'   => 'required',
            'nationality'   => 'required',
            'birthday'      => 'required',
            'phone'         => 'required',
            'tele_code'=>'required',
            'cellphone' => ($user->cellphone == $request['cellphone'])? "":((session('country')==1)?"unique:users,cellphone,,,deleted_at,NULL|digits:10":"unique:users,cellphone,,,deleted_at,NULL|digits:9"),
            'email'         => 'required',
            'discount_percentage' => 'required',
            'activate'      => 'required',
            'start_date'    => 'required',
            'end_date'      => 'required',
            // 'bouquet_id'=> 'required',
            // 'duration'      => 'required',
            // 'value'         => 'required',
            // 'number_of_installment' => 'required'
        ]);

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
            
            $user->parent_id = $request->company_code;
            $user->name      = $request->ind_name;
            $user->password  = bcrypt($request->password);
            $user->full_name = $request->ind_name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->tele_code = $request->tele_code ;
            $user->cellphone = $request->cellphone ;
            // $user->mobile = preg_replace("/0/", "+", $request->mobile, 1);
            $user->mobile = $request->tele_code . $request->cellphone;
            $user->address   = $request->address;
            $user->birthdate = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->country_id=session('country');
            $user->save();
        } catch(Exception $ex) {
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // Add Code to company
        try {
            $user->code = $user->id;
            $user->save();
        } catch (Exception $ex) {
            Session::flash('warning', 'خطأ في كود الشركة');
            return redirect()->back()->withInput();
        }

        // if user is individual and we want to change him/her to individual-company client then change his/her rule.
        try {
            $user_rule = Users_Rules::where('user_id', $user->id)->where('rule_id', '!=', 6)->first();
            $user_rule->rule_id = 10;
            $user_rule->save();
        } catch(Exception $ex) {
            Session::flash('warning', 'حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا #2');
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
            $client_passwords->confirmation = 0;
            $client_passwords->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // TODO: national_id missing
        // push into users_details
        try {
            if(User_Details::where('user_id', $user->id)->first() != NULL) {
                $user_details = User_Details::where('user_id', $user->id)->first();
            } else {
                $user_details = new User_Details;
            }            
            $user_details->user_id       = $user->id;
            $user_details->country_id    = $request->nationality;
            $user_details->nationality_id = $request->nationality;
            $user_details->gender_id     = $request->gender;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work;
            $user_details->work_sector_type      = $request->work_type;
            $user_details->discount_percentage   = $request->discount_percentage;
            $user_details->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
            $subscription =  UserBouquet::where('user_id', $user->id)->first();
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
           
            
        } catch(Exception $ex) {
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if (isset($request->payment) && !empty($request->payment)) {
                if ($request->number_of_installments != count($request->payment)) {
                    $user->forcedelete();

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
                                'start_date'=>$start_date,
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
                                'start_date'=>$start_date,
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
        } catch(Exception $ex) {
            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // redirect with success
        Session::flash('success', 'تم تعديل العميل بنجاح');
        return redirect('/individuals_companies');
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

    public function destroyShow($id)
    {
        // Find and delete this record
        Users::find($id)->delete();
        return redirect()->route('ind.com')->with('success','تم استبعاد العميل');
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

    // Filter individuals-companies based on package_type, start-end dates and nationality
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
        $users = Users::users(10)->join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
                        ->join('user_details', 'users.id', '=', 'user_details.user_id')
                        ->select('user_details.*', 'subscriptions.*', 'users.*');

        // check company code
        if ( $request->company_code) {
            $users = $users->where('parent_id', $request->company_code);
        }
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

        // check activation 
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
        $companies     = Users::users(9)->get();
        return view('clients.individuals_companies.individuals_companies', compact(['packages', 'subscriptions', 'nationalities', 'companies']))->with('filters', $users);
    }
}
