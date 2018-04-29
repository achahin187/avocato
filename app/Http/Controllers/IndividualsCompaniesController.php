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
        $packages = Package_Types::all();
        $subscriptions = Subscriptions::all();
        $nationalities = Geo_Countries::all();
        $companies     = Users::users(9)->get();
        return view('clients.individuals_companies.individuals_companies', compact(['packages', 'subscriptions', 'nationalities', 'companies']))->with('ind_coms', Users::users(10)->get());
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
        $nationalities = Geo_Countries::all();        
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
            'mobile'        => 'required',
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
            $user->mobile    = $request->mobile;
            $user->address   = $request->address;
            $user->birthdate = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->save();
        } catch(Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
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
            $subscription = new Subscriptions;
            $subscription->user_id    = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date   = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->package_type_id   = $request->package_type_id;
            $subscription->duration = $request->duration;
            $subscription->value     = $request->value;
            $subscription->number_of_installments    = $request->number_of_payments;
            $subscription->save();
        } catch(Exception $ex) {
            $user->forcedelete();
            $user_rules->forcedelete();
            $client_passwords->forcedelete();
            $user_details->forcedelete();
            // dd($ex);
            
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if ( isset($request->payment) && !empty($request->payment) ) {
                if ( $request->number_of_payments != count($request->payment) ) {
                    $user->forcedelete();

                    Session::flash('warning', '  حدث خطأ عند ادخال بيانات العميل ، من فضلك تأكد من ان عدد الاقساط التي تم ادخالها مساوٍِِ لحقل عدد الاقساط');
                    return redirect()->back()->withInput();
                    
                } else if($request->number_of_payments != 0 && $request->number_of_payments == count($request->payment)) {
                    for($i=0; $i < $request->number_of_payments; $i++) {
                        $pay_date = date('Y-m-d', strtotime($request->payment_date[$i]));
                        Installment::create([
                            'subscription_id'   => $subscription->id,
                            'installment_number'=> $i+1,
                            'value' => $request->payment[$i],
                            'payment_date'  => $pay_date,
                            'is_paid'   => $request->payment_status[$i]
                        ]);
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
        $data['user'] = Users::find($id);
        $data['packages'] = Entity_Localizations::where('field','name')->where('entity_id',1)->get();
        $data['cases'] = Case_Client::where('client_id', $id)->get();

        // get urgent
        $data['urgents'] =  Tasks::where('client_id', $id)->where('task_type_id', 1)->get();

        // get paid and free services only
        $data['services'] =  Tasks::where('client_id', $id)->where('task_type_id', 3)->get();

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
        $user = Users::find($id);
        $password = $user->client_password ? $user->client_password->password : $user->password;
        $subscription_types = Package_Types::all();
        $nationalities = Geo_Countries::all();  
        $installments = $user->subscription ? Installment::where('subscription_id', $user->subscription->id)->get() : 0;
        $companies = Users::users(9)->get();

        return view('clients.individuals_companies.individuals_companies_edit', compact(['user', 'password', 'subscription_types', 'nationalities', 'installments', 'companies']) );
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
            'mobile'        => 'required',
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
            $user->mobile    = $request->mobile;
            $user->address   = $request->address;
            $user->birthdate = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
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
            $client_passwords = ClientsPasswords::where('user_id', $user->id)->first();
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
            $user_details = User_Details::where('user_id', $user->id)->first();
            
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
            $subscription = Subscriptions::where('user_id', $user->id)->first();
            $subscription->user_id    = $user->id;
            $subscription->start_date = date('Y-m-d H:i:s', strtotime($request->start_date));
            $subscription->end_date   = date('Y-m-d H:i:s', strtotime($request->end_date));
            $subscription->package_type_id   = $request->package_type_id;
            $subscription->duration = $request->duration;
            $subscription->value     = $request->value;
            $subscription->number_of_installments    = $request->number_of_payments;
            $subscription->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if ( isset($request->payment) && !empty($request->payment) ) {
                if ( $request->number_of_payments != count($request->payment) ) {
                    $user->forcedelete();

                    Session::flash('warning', '  حدث خطأ عند ادخال بيانات العميل ، من فضلك تأكد من ان عدد الاقساط التي تم ادخالها مساوٍِِ لحقل عدد الاقساط');
                    return redirect()->back()->withInput();
                    
                } else if($request->number_of_payments != 0 && $request->number_of_payments == count($request->payment) ) {
                    Installment::where('subscription_id', $subscription->id)->delete();
                    for($i=0; $i < $request->number_of_payments; $i++) {
                        $pay_date = date('Y-m-d', strtotime($request->payment_date[$i]));
                        Installment::create([
                            'subscription_id'   => $subscription->id,
                            'installment_number'=> $i+1,
                            'value' => $request->payment[$i],
                            'payment_date'  => $pay_date,
                            'is_paid'   => $request->payment_status[$i]
                        ]);
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
