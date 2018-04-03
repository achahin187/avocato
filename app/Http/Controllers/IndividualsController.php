<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use Session;
use Exception;

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

class IndividualsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.individuals.individuals')->with('users', Users::users(8)->get());
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
        
        return view('clients.individuals.individuals_create', compact(['code', 'password', 'subscription_types', 'nationalities']));
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
            'name'  => 'required',
            'job'   => 'required',
            'address'   => 'required',
            'national_id'   => 'required',
            'birthday'  => 'required',
            'nationality'   => 'required',
            'mobile'    => 'required',
            'email' => 'email',
            'personal_image'=> 'image|mimes:jpeg,jpg,png',
            'start_date'    => 'required',
            'end_date'  => 'required',
            'subscription_duration' => 'required',
            'subscription_value' => 'required',
            'number_of_payments' => 'required'
        ],[
            'email.email' => 'من فضلك تأكد من ادخال البريد الالكتروني بشكل صحيح',
        ]);

        // upload image to storage/app/public
        if($request->personal_image) {
            $img = $request->personal_image;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('storage/app/public/individuals', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/individuals/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            // if user didn't pick an image and he choose male then assign male.jpg as his image.
            if ( $request->gender == 1 ) {
                $imgPath = 'public/img/avatars/male.jpg';
            } else {
                // else assign female.jpg as her image.
                $imgPath = 'public/img/avatars/female.jpg';
            }
        }

        // INSERT INDIVIDUAL DATA
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
            $user->code      = $request->code;
            $user->birthdate  = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->save();
        } catch(Exception $ex) {
            $user->forcedelete();
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }
        
        // push into users_rules
        try {
            $data = array(
                array('user_id' => $user->id, 'rule_id' => 6),
                array('user_id' => $user->id, 'rule_id' => 8)
            );

            Users_Rules::insert($data);
        } catch(Exception $ex) {
            $user->forcedelete();
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
        
        // push into users_details
        try {
            $user_details = new User_Details;
            
            $user_details->user_id       = $user->id;
            $user_details->country_id    = $request->nationality;
            $user_details->gender_id     = $request->gender;
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
            $subscription->package_type_id   = $request->subscription_type;
            $subscription->duration  = $request->subscription_duration;
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
        $data['user'] = Users::find($id);
        $data['packages'] = Entity_Localizations::where('field','name')->where('entity_id',1)->get();
        return view('clients.individuals.individuals_show',$data);
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
        $password = $user->client_password->password;
        $subscription_types = Package_Types::all();
        $nationalities = Geo_Countries::all();  
        $installments = Installment::where('subscription_id', $user->subscription->id)->get();

        return view('clients.individuals.individuals_edit', compact(['user', 'password', 'subscription_types', 'nationalities', 'installments']));
    }
    
    public function ins_update(Request $request, $id)
    {
        $installment = Installment::find($id);
        $installment->is_paid = $request->installment;
        $installment->save();
        
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
        $this->validate($request, [
            'name'  => 'required',
            'job'   => 'required',
            'address'   => 'required',
            'national_id'   => 'required',
            'birthday'  => 'required',
            'nationality'   => 'required',
            'mobile'    => 'required',
            'email' => 'email',
            'personal_image'=> 'image|mimes:jpeg,jpg,png',
            'start_date'    => 'required',
            'end_date'  => 'required',
            'subscription_duration' => 'required',
            'subscription_value' => 'required',
            'number_of_payments' => 'required'
        ],[
            'email.email' => 'من فضلك تأكد من ادخال البريد الالكتروني بشكل صحيح',
        ]);

        // Find this user to edit him/her
        $user = Users::find($id);
        
        // upload image to storage/app/public
        if($request->personal_image) {
            $img = $request->personal_image;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('storage/app/public/individuals', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/individuals/'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = $user->image;
        }

        // INSERT INDIVIDUAL DATA
        // push into users
        try {
            $user->name      = $request->name;
            if ( $request->password != null && $request->password != '' ) {
                $user->password  = bcrypt($request->password);
            }
            $user->full_name = $request->name;
            $user->email     = $request->email;
            $user->image     = $imgPath;
            $user->phone     = $request->phone;
            $user->mobile    = $request->mobile;
            $user->address   = $request->address;
            $user->code      = $request->code;
            $user->birthdate  = date('Y-m-d', strtotime($request->birthday));
            $user->is_active = $request->activate;
            $user->created_by= Auth::user()->id;
            $user->save();
        } catch(Exception $ex) {
            Session::flash('warning', 'إسم العميل موجود بالفعل ، برجاء استبداله والمحاولة مجدداَ #1');
            return redirect()->back()->withInput();
        }

        // push into client_passwords
        try {
            $client_passwords = ClientsPasswords::where('user_id', $user->id)->first();
            $client_passwords->user_id = $user->id;
            if($request->password != null && $request->password != '') {
                $client_passwords->password = $request->password;
            }
            $client_passwords->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 3# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }
        
        // push into users_details
        try {
            $user_details = User_Details::where('user_id', $user->id)->first();
            
            $user_details->user_id       = $user->id;
            $user_details->country_id    = $request->nationality;
            $user_details->nationality_id= $request->nationality;
            $user_details->gender_id     = $request->gender;
            $user_details->job_title     = $request->job;
            $user_details->national_id   = $request->national_id;
            $user_details->work_sector   = $request->work;
            $user_details->work_sector_type      = $request->work_type;
            $user_details->discount_percentage   = $request->discount_rate;
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
            $subscription->duration  = $request->subscription_duration;
            $subscription->value     = $request->subscription_value;
            $subscription->number_of_installments    = $request->number_of_payments;
            $subscription->save();
        } catch(Exception $ex) {
            Session::flash('warning', ' 5# حدث خطأ عند ادخال بيانات العميل ، برجاء مراجعة الحقول ثم حاول مجددا');
            return redirect()->back()->withInput();
        }

        // push into installments
        try {
            if($request->number_of_payments != 0 && $request->number_of_payments != '') {
                Installment::where('subscription_id', $subscription->id)->delete();
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
        } catch(Exception $ex) {
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
        return redirect()->route('ind')->with('success','تم استبعاد العميل');
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
