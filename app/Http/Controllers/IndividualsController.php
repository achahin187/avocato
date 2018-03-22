<?php

namespace App\Http\Controllers;

use Session;

use App\Users;
use App\User_Details;
use App\Users_Rules;
use App\ClientsPasswords;
use App\Subscriptions;
use App\Package_Types;
use App\Installment;
use Illuminate\Http\Request;
use App\Rules;

class IndividualsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.individuals.individuals')->with('users', Users::individuals()->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastId = Users::orderBy('id', 'desc')->first();
        $newId = $lastId->id + 1;
        
        $password = rand($newId, 99999999);
        $subscription_types = Package_Types::all();
        return view('clients.individuals.individuals_create', compact(['newId', 'password', 'subscription_types']));
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
            'phone' => 'required',
            'mobile'    => 'required',
            'email' => 'required|email',
            'work'  => 'required',
            'work_type' =>'required',
            'personal_image'=> 'image|mimes:jpeg,jpg,png',
            'discount_rate' => 'required',
            'start_date'    => 'required',
            'end_date'  => 'required',
            'subscription_duration' => 'required',
            'subscription_value' => 'required',

        ]);

        // upload image to storage/app/public
        if($request->personal_image) {
            $img = $request->personal_image;
            $newImg = $request->code.'_'.time().$img->getClientOriginalName(); // current time + original image name
            $img->move('storage/app/public/individuals', $newImg);      // move to /storage/app/public
            $imgPath = 'storage/app/public/individuals'.$newImg;       // new path: /storage/app/public/imageName
        } else {
            $imgPath = null;
        }

        // INSERT INDIVIDUAL DATA
        // push into users
        $user = Users::create([
            'name'      => $request->name,
            'password'  => $request->password,
            'full_name' => $request->name,
            'email'     => $request->email,
            'image'     => $newImg,
            'phone'     => $request->phone,
            'mobile'    => $request->mobile,
            'address'   => $request->address,
            'code'      => $request->code,
            'birthday'  => $request->birthday,
            'is_active' => $request->activate,
            'created_by'=> 1
        ]);

        // push into users_rules
        Users_Rules::create([
            'user_id'   => $user->id,
            'rule_id'   => 8
        ]);

        // push into client_passwords
        ClientsPasswords::create([
            'user_id'   => $user->id,
            'password'  => $request->password,
            'confirmation'  => 0
        ]);

        // push into users_details
        User_Details::create([
            'user_id'       => $user->id,
            'country_id'    => 1,
            'gender_id'     => $request->gender_id,
            'job_title'     => $request->job,
            'national_id'   => $request->national_id,
            'work_sector'   => $request->work,
            'work_sector_type'      => $request->work_type,
            'discount_percentage'   => $request->discount_rate,
        ]);

        // push into subscriptions
        $subscription = Subscriptions::create([
            'user_id'    => $user->id,
            'start_date' => date('Y-m-d H:i:s', strtotime($request->start_date)),
            'end_date'   => date('Y-m-d H:i:s', strtotime($request->end_date)),
            'package_type_id'   => $request->subscription_type,
            'duaration' => $request->subscription_duration,
            'value'     => $request->subscription_value,
            'number_of_installments'    => $request->number_of_payments
        ]);

        // push into installments
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
    public function show()
    {
        return view('clients.individuals.individuals_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('clients.individuals.individuals_edit');
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
