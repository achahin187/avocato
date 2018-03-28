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
        $nationalities = Entity_Localizations::whereIn('item_id', $ids)->where('entity_id', 6)->get();  // select only arabic nationalities
        
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
        // dd($request->all());
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
            $img->move('storage/app/public/companies', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/companies/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = null;
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
            $user_rules = new Users_Rules;
            $user_rules->user_id   = $user->id;
            $user_rules->rule_id   = 10;
            $user_rules->save();
        
        } catch(Exception $ex) {
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
        } catch(Exception $ex) {
            dd($ex);
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
        return redirect('/individuals_companies');
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
