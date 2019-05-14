<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use Session;
use Exception;
use Validator;
use App\Users;
use App\User_Details;
use App\Users_Rules;
use App\ClientsPasswords;
use App\Subscriptions;
use App\Package_Types;
use App\Installment;
use Illuminate\Http\Request;
use Illuminate\DatabaseException;
use App\Rules;
use App\Geo_Countries;
use App\Entity_Localizations;
use App\Case_;
use App\Case_Client;
use App\Tasks;
use App\Procurations;
use App\Helpers\VodafoneSMS;
use App\Bouquet;
use App\BouquetPaymentMethod;
use App\BouquetMethod;
use App\BouquetPrice;
use App\BouquetService;
use App\BouquetServiceCount;
use App\UserBouquet;
use App\UserBouquetPayment;
use App\UserBouquetServiceCount;

class IndividualsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Bouquet::all();
        $subscriptions = Subscriptions::all();
        $nationalities = Geo_Countries::all();
        return view('clients.individuals.individuals', compact(['packages', 'subscriptions', 'nationalities']))
                ->with('users', Users::users(8)->where('country_id',Auth::user()->country_id)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // custom helper function to generate a random number and check if this random number exists on a specific table
        $code = Helper::generateRandom(Users::class, 'code', 6);
        $password = rand(10000000, 99999999);
        $bouquets = Bouquet::where('bouquet_type',0)->with('payment')->with('price_relation')->get();
        $nationalities = Geo_Countries::all();
        
        return view('clients.individuals.individuals_create', compact(['code', 'password', 'bouquets', 'nationalities']));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'job' => 'required',
            'address' => 'required',
            'national_id' => 'required',
            'birthday' => 'required|date',
            'nationality' => 'required',
            'tele_code'=>'required',
            'cellphone' => (session('country') == 1)?'required|digits:10|unique:users,cellphone,,,deleted_at,NULL':'required|digits:9|unique:users,cellphone,,,deleted_at,NULL',
            'email' => 'email',
            'personal_image' => 'image|mimes:jpeg,jpg,png',
            'start_date' => 'required',
            'end_date' => 'required',
            'subscription_duration' => 'required',
            'subscription_value' => 'required',
            'number_of_payments' => 'required' ]
            ,[
                'email.email' => 'من فضلك تأكد من ادخال البريد الالكتروني بشكل صحيح',
                'birthday.date' => 'من فضلك تأكد من ادخال تاريخ ميلاد صحيح',
            ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // upload image to storage/app/public
        if ($request->personal_image) {
            $img = $request->personal_image;
            $newImg = $request->code . '_' . time() . $img->getClientOriginalName(); // current time + original image name
            $img->move('users_images', $newImg);      // move to public/users_images
            $imgPath = 'users_images/' . $newImg;       // new path: public/useres_images/new.jgp 
        } else {
            // if user didn't pick an image and he choose male then assign male.jpg as his image.
            if ($request->gender == 1) {
                $imgPath = 'users_images/male.jpg';
            } else {
                // else assign female.jpg as her image.
                $imgPath = 'users_images/female.jpg';
            }
        }

        // INSERT INDIVIDUAL DATA
        // push into users
        try {
            $user = new Users();
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->full_name = $request->name;
            $user->email = $request->email;
            $user->image = $imgPath;
            $user->phone = $request->phone;
            $user->tele_code = $request->tele_code ;
            $user->cellphone = $request->cellphone ;
            // $user->mobile = preg_replace("/0/", "+", $request->mobile, 1);
            $user->mobile = $request->tele_code . $request->cellphone;
            $user->address = $request->address;
            $user->code = $request->code;
            $user->birthdate = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by = Auth::user()->id;
            $user->country_id= session('country');
            $user->save();
        } catch (Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', $ex);
            return redirect()->back()->withInput();
        }
        
        // push into users_rules
        try {
            $data = array(
                array('user_id' => $user->id, 'rule_id' => 6),
                array('user_id' => $user->id, 'rule_id' => 8)
            );

            Users_Rules::insert($data);
        } catch (Exception $ex) {
            $user->forcedelete();
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
        } catch (Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // push into users_details
        try {
            $user_details = new User_Details;
            $user_details->user_id = $user->id;
            $user_details->country_id = $request->nationality;
            $user_details->nationality_id = $request->nationality;
            $user_details->gender_id = $request->gender;
            $user_details->job_title = $request->job;
            $user_details->national_id = $request->national_id;
            $user_details->work_sector = $request->work;
            $user_details->work_sector_type = $request->work_type;
            $user_details->discount_percentage = $request->discount_rate;
            $user_details->save();
        } catch (Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
            $subscription = new UserBouquet;
            $subscription->user_id = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->bouquet_id = $request->subscription_type;
            $subscription->duration = $request->subscription_duration;
            $subscription->value = $request->subscription_value;
            $subscription->number_of_installments = $request->number_of_payments;
            $subscription->is_active = $request->is_active;
            $subscription->save();
        } catch (Exception $ex) {
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
                if ($request->number_of_payments != count($request->payment)) {
                    $user->forcedelete();

                    Session::flash('warning', '  حدث خطأ عند ادخال بيانات العميل ، من فضلك تأكد من ان عدد الاقساط التي تم ادخالها مساوٍِِ لحقل عدد الاقساط');
                    return redirect()->back()->withInput();

                } else if ($request->number_of_payments != 0 && $request->number_of_payments == count($request->payment)) {
                    for ($i = 0; $i < $request->number_of_payments; $i++) {
                        $pay_date = date('Y-m-d', strtotime($request->payment_date[$i]));
                        UserBouquetPayment::create([
                            'user_id' => $user->id,
                            'bouquet_id'=>$request->subscription_type,
                            'payment_method'=>$request->payment_method,
                            'period' => $i + 1,
                            'price' => $request->payment[$i],
                            'actuall_start_date' => $pay_date,
                            'payment_status' => $request->payment_status[$i]
                        ]);
                    }
                }
            }
        } catch (Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // redirect with success
        $vodafone = new VodafoneSMS;
        $status =$vodafone::send($user->mobile,$request->code , $request->password);
        Session::flash('success', 'تم إضافة العميل بنجاح');
        return redirect('/individuals');
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
            return redirect('/individuals');
        }

        $data['packages'] = Entity_Localizations::where('field', 'name')->where('entity_id', 1)->get();
        $data['cases'] = Case_Client::where('client_id', $id)->get();

        // get urgent
        $data['urgents'] = Tasks::where('client_id', $id)->where('task_type_id', 1)->get();

        // get paid and free services only
        $data['services'] = Tasks::where('client_id', $id)->where('task_type_id', 3)->get();
        $data['procurations'] = Procurations::where('client_id', $id)->get();
        return view('clients.individuals.individuals_show', $data);
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
            return redirect('/individuals');
        }

        $password = $user->client_password ? ($user->client_password->password ? : 12345678) : 12345678;
        $subscription_types = Package_Types::all();
        $nationalities = Geo_Countries::all();
        $installments = $user->subscription ? $user->subscription->installments : 0;

        return view('clients.individuals.individuals_edit', compact(['user', 'password', 'subscription_types', 'nationalities', 'installments']));
    }

    public function ins_update(Request $request, $id)
    {
        $installment = Installment::find($id);
        $installment->is_paid = $request->installment;
        $installment->save();
        return redirect()->back();

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
        // Validate data
        $user = Users::find($id);
        $validator = Validator::make($request->all(), [
        'name' => 'required',
        'job' => 'required',
        'address' => 'required',
        'national_id' => 'required',
        'birthday' => 'required|date',
        'nationality' => 'required',
        'tele_code'=>'required',
        'cellphone' => ($user->cellphone == $request['cellphone'])? "":((session('country')==1)?"unique:users,cellphone,,,deleted_at,NULL|digits:10":"unique:users,cellphone,,,deleted_at,NULL|digits:9"),
        'email' => 'email',
        'personal_image' => 'image|mimes:jpeg,jpg,png',
        'start_date' => 'required',
        'end_date' => 'required',
        'subscription_duration' => 'required',
        'subscription_value' => 'required',
        'number_of_payments' => 'required' ]
        ,[
            'email.email' => 'من فضلك تأكد من ادخال البريد الالكتروني بشكل صحيح',
            'birthday.date' => 'من فضلك تأكد من ادخال تاريخ ميلاد صحيح',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find this user to edit him/her
        // $user = Users::find($id);
        
        // upload image to storage/app/public
        if ($request->personal_image) {
            $img = $request->personal_image;
            $newImg = $request->code . '_' . time() . $img->getClientOriginalName(); // current time + original image name
            $img->move('users_images', $newImg);      // move to /storage/app/public
            $imgPath = 'users_images/' . $newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = $user->image;
        }

        // INSERT INDIVIDUAL DATA
        // push into users
        try {
            $user->name = $request->name;
            if ($request->password != null && $request->password != '') {
                $user->password = bcrypt($request->password);
            }
            $user->full_name = $request->name;
            $user->email = $request->email;
            $user->image = $imgPath;
            $user->phone = $request->phone;
            $user->tele_code = $request->tele_code ;
            $user->cellphone = $request->cellphone ;
            $user->mobile = $request->tele_code.$request->cellphone;
            $user->address = $request->address;
            $user->code = $request->code;
            $user->birthdate = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by = Auth::user()->id;

            $user->parent_id = null;    // in case of transforming individuals to individual-company clients.
            $user->country_id=session('country');
            $user->save();
        } catch (Exception $ex) {
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // push into client_passwords
        try {
            if (ClientsPasswords::where('user_id', $user->id)->first() != null) {
                $client_passwords = ClientsPasswords::where('user_id', $user->id)->first();
            } else {
                $client_passwords = new ClientsPasswords;
            }

            $client_passwords->user_id = $user->id;
            if ($request->password != null && $request->password != '') {
                $client_passwords->password = $request->password;
            }
            $client_passwords->save();
        } catch (Exception $ex) {
            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // push into users_details
        try {
            if (User_Details::where('user_id', $user->id)->first() != null) {
                $user_details = User_Details::where('user_id', $user->id)->first();
            } else {
                $user_details = new User_Details;
            }

            $user_details->user_id = $user->id;
            $user_details->country_id = $request->nationality;
            $user_details->nationality_id = $request->nationality;
            $user_details->gender_id = $request->gender;
            $user_details->job_title = $request->job;
            $user_details->national_id = $request->national_id;
            $user_details->work_sector = $request->work;
            $user_details->work_sector_type = $request->work_type;
            $user_details->discount_percentage = $request->discount_rate;
            $user_details->save();
        } catch (Exception $ex) {
            dd($ex);
            Session::flash('warning', ' 4# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // if user is individual-company client and we want to change him/her to individual client then change his/her rule.
        try {
            $user_rule = Users_Rules::where('user_id', $user->id)->where('rule_id', '!=', 6)->first();
            $user_rule->rule_id = 8;
            $user_rule->save();
        } catch (Exception $ex) {
            Session::flash('warning', 'حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا #2');
            return redirect()->back()->withInput();
        }

        // push into subscriptions
        try {
            $subscription = Subscriptions::where('user_id', $user->id)->first();
            $subscription->user_id = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->package_type_id = $request->subscription_type;
            $subscription->duration = $request->subscription_duration;
            $subscription->value = $request->subscription_value;
            $subscription->number_of_installments = $request->number_of_payments;
            $subscription->save();
        } catch (Exception $ex) {
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if (isset($request->payment) && !empty($request->payment)) {
                if ($request->number_of_payments != count($request->payment)) {
                    $user->forcedelete();

                    Session::flash('warning', '  حدث خطأ عند ادخال بيانات العميل ، من فضلك تأكد من ان عدد الاقساط التي تم ادخالها مساوٍِِ لحقل عدد الاقساط');
                    return redirect()->back()->withInput();

                } else if ($request->number_of_payments != 0 && $request->number_of_payments == count($request->payment)) {
                    Installment::where('subscription_id', $subscription->id)->delete();
                    for ($i = 0; $i < $request->number_of_payments; $i++) {
                        $pay_date = date('Y-m-d', strtotime($request->payment_date[$i]));
                        Installment::create([
                            'subscription_id' => $subscription->id,
                            'installment_number' => $i + 1,
                            'value' => $request->payment[$i],
                            'payment_date' => $pay_date,
                            'is_paid' => $request->payment_status[$i]
                        ]);
                    }
                }
            }
        } catch (Exception $ex) {
            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // redirect with success
        Session::flash('success', 'تم تعديل العميل بنجاح');
        return redirect('/individuals');
    }

    public function destroy($id)
    {
        // Find and delete this record
        Users::find($id)->delete();

        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function destroyShow($id)
    {
        // Find and delete this record
        Users::find($id)->delete();
        return redirect()->route('ind')->with('success', 'تم استبعاد العميل');
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

    // Filter individuals based on package_type, start-end dates and nationality
    public function filter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activate' => 'required'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('individuals#filterModal_sponsors')
                ->withErrors($validator)
                ->withInput();
        }

        $startfrom = Helper::checkDate($request->start_date_from, 1);
        $startto = Helper::checkDate($request->start_date_to, 2);
        $endfrom = Helper::checkDate($request->end_date_from, 1);
        $endto = Helper::checkDate($request->end_date_to, 2);

        // intial join query between `users` & `subscriptions` & `user_details`
        $users = Users::where('users.country_id',session('country'))->users(8)->join('subscriptions', 'users.id', '=', 'subscriptions.user_id')
            ->join('user_details', 'users.id', '=', 'user_details.user_id')
            ->select('user_details.*', 'subscriptions.*', 'users.*');

        // check package type
        if ($request->package_type) {
            $users = $users->whereIn('package_type_id', $request->package_type);
        }

        // check on start and end dates
        if ($startfrom && $startto && $endfrom && $endto) {
            $users = $users->whereBetween('start_date', [$startfrom, $startto]);
            $users = $users->whereBetween('end_date', [$endfrom, $endto]);
        }

        // check nationality
        if ($request->nationality) {
            $users = $users->where('user_details.nationality_id', $request->nationality);
        }

        switch ($request->activate) {
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

        return view('clients.individuals.individuals', compact(['packages', 'subscriptions', 'nationalities']))->with('filters', $users);
    }
}
