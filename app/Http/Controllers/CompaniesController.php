<?php

namespace App\Http\Controllers;

use Auth;
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
        $ids = array();
        
        $password = rand(10000000, 99999999);
        $subscription_types = Package_Types::all();

        $nationalities = Geo_Countries::all();
        $packages = Package_Types::all();
        

        return view('clients.companies.companies_create', compact(['password', 'subscription_types', 'nationalities', 'packages']));
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
            'password' => 'required',
            'name'  => 'required',
            'nationality' => 'required',
            'commercial_registration_number' => 'required',
            'legal_representative_name' => 'required',
            'address'   => 'required',
            'phone' => 'required',
            'mobile'    => 'required',
            'email' => 'required|email',
            'work_sector' =>'required',
            'legal_representative_mobile' => 'required',
            'logo'=> 'image|mimes:jpeg,jpg,png',
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
            $user->password  = bcrypt($request->password);
            $user->full_name = $request->name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->mobile    = $request->mobile;
            $user->address   = $request->address;
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
                array('user_id' => $user->id, 'rule_id' => 9)
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
            $user_details->gender_id     = $request->gender;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work_sector;
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
            $subscription->duration = $request->subscription_duration;
            $subscription->value     = $request->subscription_value;
            $subscription->number_of_installments    = $request->number_of_payments;
            $subscription->save();
        } catch(Exception $ex) {
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
        } catch(Exception $ex) {
            Users::find($user->id)->forcedelete();
            Session::flash('warning', '7 حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجدد');
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
        } catch(Exception $ex) {
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
        return view('clients.companies.companies_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Users::find($id);
        $password = $company->client_password->password;
        $subscription_types = Package_Types::all();
        $nationalities = Geo_Countries::all();
        $installments = Installment::where('subscription_id', $company->subscription->id)->get();

        return view('clients.companies.companies_edit', compact(['company', 'password', 'subscription_types', 'nationalities', 'installments']));
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
        // dd($request->all());
        $this->validate($request, [
            'company_code'  => 'required',  // users
            'password'      => 'required',  // usres - client_password
            'company_name'  => 'required',  // users
            'nationality'   => 'required',  // user_details
            'address'       => 'required',  // users
            'phone'         => 'required',  // users
            'mobile'        => 'required',  // users
            'fax'           => 'required',  // user_company_details
            'website'       => 'required',  // user_company_details
            'work_sector'   => 'required',  // user_details
            'email'         => 'required',  // users
            'activate'      => 'required',  // users as is_active
            'start_date'    => 'required',  // subscription
            'end_date'      => 'required',  // subscription
            'logo'          => 'image|mimes:jpeg,jpg,png',  // users as image
            'subscription_type'     => 'required',  // subscriptions as package_type_id
            'subscription_duration' => 'required',  // subscriptions as duration
            'subscription_value'    => 'required',  // subscriptions as value
            'number_of_payments'    => 'required',  // subscriptions as number_of_installments
            'discount_percentage'   => 'required',  // user_details
            'legal_representative_name'     => 'required',  // user_company_details
            'legal_representative_mobile'   => 'required',  // user_company_details
            'commercial_registration_number'    => 'required',  // user_company details
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
            $user = Users::find($id);
            $user->name      = $request->company_name;
            $user->password  = bcrypt($request->password);
            $user->full_name = $request->company_name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->mobile    = $request->mobile;
            $user->address   = $request->address;
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->save();
        } catch(Exception $ex) {
            dd($ex);
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // push into client_passwords
        try {
            $client_passwords = ClientsPasswords::where('user_id', $user->id)->first();
            $client_passwords->user_id = $user->id;
            $client_passwords->password = $request->password;
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
            $user_details->gender_id     = $request->gender;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work_sector;
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
            $subscription->package_type_id   = $request->subscription_type;
            $subscription->duration = $request->subscription_duration;
            $subscription->value     = $request->subscription_value;
            $subscription->number_of_installments    = $request->number_of_payments;
            $subscription->save();
        } catch(Exception $ex) {
            dd($ex);
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into user_company_detail
        try {
            $ucd = User_Company_Details::where('user_id', $user->id)->first();
            $ucd->user_id   = $user->id;
            $ucd->commercial_registration_number = $request->commercial_registration_number;
            $ucd->fax     = $request->fax;
            $ucd->website = $request->website;
            $ucd->legal_representative_name      = $request->legal_representative_name;
            $ucd->legal_representative_mobile    = $request->legal_representative_mobile;
            $ucd->save();
        } catch(Exception $ex) {
            Session::flash('warning', '7 حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجدد');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if($request->number_of_payments != 0 && $request->number_of_payments != '') {
                Installment::where('subscription_id', $subscription->id)->forcedelete();
                for($i=0; $i < $request->number_of_payments; $i++) {
                    $key = array_keys($request->payment_status[$i]);
                    $pay_date = date('Y-m-d', strtotime($request->payment_date[$i]));
                    
                    $installment = new Installment;
                    $installment->subscription_id   = $subscription->id;
                    $installment->installment_number = $i+1;
                    $installment->value = $request->payment[$i];
                    $installment->payment_date  = $pay_date;
                    $installment->is_paid   = $key[0];
                    $installment->save(); 
                }
            }
        }catch(Exception $ex) {
            Session::flash('warning', ' 6# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // redirect with success
        Session::flash('success', 'تم إضافة العميل بنجاح');
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
}
