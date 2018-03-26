<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\User_Details;
use App\Rules;
use App\Geo_Countries;
use App\Entity_Localizations;
use App\ClientsPasswords;
use Validator;
use Helper;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;


class LawyersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['lawyers'] = Users::whereHas('rules', function($q){
        $q->whereIn('name',['secure bridge lawyer','free lawyer']);
        })->get();
        $data['nationalities'] = Entity_Localizations::where('field','nationality')->get();
        return view('lawyers.lawyers',$data);
    }

    public function follow()
    {
        return view('lawyers.lawyers_follow');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['nationalities'] = Entity_Localizations::where('field','nationality')->get();
        $data['types']=Rules::whereIn('id',[11,12])->get();
        return view('lawyers.lawyers_create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lawyer_name'=>'required',
            'address'=>'required',
            'nationality'=>'required',
            'national_id'=>'required|numeric',
            'birthdate'=>'required',
            'phone'=>'required|digits_between:1,10',
            'mobile'=>'required|digits_between:1,12',
            'email'=>'required|email|max:40',
            'image'=>'required|image|mimes:jpg,jpeg,png|max:1024',
            'is_active'=>'required',
            'work_sector'=>'required',
            'work_sector_type'=>'required',
            'join_date'=>'required',
            'resign_date'=>'required',
            'work_type'=>'required',
            'litigation_level'=>'required',
            'authorization_copy'=>'required|image|mimes:jpg,jpeg,png|max:1024',
            'syndicate_level'=>'required',
            'syndicate_copy'=>'required|image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        if($request->hasFile('image')){
            $image_name=$request->lawyer_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            $destinationPath='users_images';
            Input::file('image')->move($destinationPath, $image_name);
        }

        if($request->hasFile('authorization_copy')){
            $authorization_copy=$request->lawyer_name.time().rand(111,999).'.'.Input::file('authorization_copy')->getClientOriginalExtension();
            $destinationPath='lawyers_files/authorization_copy';
            Input::file('authorization_copy')->move($destinationPath, $authorization_copy);
        }

        if($request->hasFile('syndicate_copy')){
            $syndicate_copy=$request->lawyer_name.time().rand(111,999).'.'.Input::file('syndicate_copy')->getClientOriginalExtension();
            $destinationPath='lawyers_files/syndicate_copy';
            Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
        }

        $lawyer=new Users;
        $lawyer->name = $request->lawyer_name.$lawyer->id;
        $lawyer->full_name = $request->lawyer_name;
        $lawyer->address = $request->address;
        $lawyer->phone = $request->phone;
        $lawyer->mobile = $request->mobile;
        $lawyer->email = $request->email;
        $lawyer->is_active = $request->is_active;
        $lawyer->birthdate =date('Y-m-d H:i:s',strtotime($request->birthdate)); 
        $lawyer->image = $image_name;
        $lawyer->save();
        $lawyer=Users::find($lawyer->id);
        $password = Helper::generateRandom(Users::class, 'password', 8);
        $lawyer->password = bcrypt($password);
        $lawyer->code = 'code-'.Helper::generateRandom(Users::class, 'code', 6);
        $lawyer->save();
        $lawyer->rules()->attach($request->work_type);
        $lawyer_details = new User_Details;
        $lawyer_details->national_id = $request->national_id;
        $lawyer_details->nationality_id = $request->nationality;
        $lawyer_details->work_sector = $request->work_sector;
        $lawyer_details->work_sector_type = $request->work_sector_type;
        $lawyer_details->join_date = date('Y-m-d H:i:s',strtotime($request->join_date));
        $lawyer_details->resign_date = date('Y-m-d H:i:s',strtotime($request->resign_date));
        $lawyer_details->litigation_level = $request->litigation_level ;
        $lawyer_details->syndicate_level = $request->syndicate_level ;
        $lawyer_details->authorization_copy = $authorization_copy ;
        $lawyer_details->syndicate_copy = $syndicate_copy ;
        $lawyer_plaintext = new ClientsPasswords;
        $lawyer_plaintext->password = $password;
        $lawyer->user_detail()->save($lawyer_details);
        $lawyer->client_password()->save($lawyer_plaintext);
        return redirect()->route('lawyers_create')->with('success','تم إضافه محامي جديد بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('lawyers.lawyers_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['lawyer'] = Users::find($id);
        $data['nationalities'] = Entity_Localizations::where('field','nationality')->get();
        $data['types'] = Rules::whereIn('id',[11,12])->get();
        return view('lawyers.lawyers_edit',$data);
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
        $validator = Validator::make($request->all(), [
            'lawyer_name'=>'required',
            'address'=>'required',
            'nationality'=>'required',
            'national_id'=>'required|numeric',
            'birthdate'=>'required',
            'phone'=>'required|digits_between:1,10',
            'mobile'=>'required|digits_between:1,12',
            'email'=>'required|email|max:40',
            'is_active'=>'required',
            'work_sector'=>'required',
            'work_sector_type'=>'required',
            'join_date'=>'required',
            'resign_date'=>'required',
            'work_type'=>'required',
            'litigation_level'=>'required',
            'syndicate_level'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }


        $lawyer= Users::find($id);
        $lawyer->name = $request->lawyer_name.$lawyer->id;
        $lawyer->full_name = $request->lawyer_name;
        $lawyer->address = $request->address;
        $lawyer->phone = $request->phone;
        $lawyer->mobile = $request->mobile;
        $lawyer->email = $request->email;
        $lawyer->is_active = $request->is_active;
        $lawyer->birthdate =date('Y-m-d H:i:s',strtotime($request->birthdate)); 
        if($request->hasFile('image')){
            $image_name=$request->lawyer_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            $destinationPath='users_images';
            Input::file('image')->move($destinationPath, $image_name);
            File::delete('users_images/'.$lawyer->image);
            $lawyer->image = $image_name;

        }

        $lawyer->save();
        $lawyer=Users::find($id);
        // $password = Helper::generateRandom(Users::class, 'password', 8);
        // $lawyer->password = bcrypt($password);
        // $lawyer->code = 'code-'.Helper::generateRandom(Users::class, 'code', 6);
        $lawyer->save();
        $lawyer->rules()->detach();
        $lawyer->rules()->attach($request->work_type);
        $lawyer_details = User_Details::where('user_id',$id)->first();;
        $lawyer_details->national_id = $request->national_id;
        $lawyer_details->nationality_id = $request->nationality;
        $lawyer_details->work_sector = $request->work_sector;
        $lawyer_details->work_sector_type = $request->work_sector_type;
        $lawyer_details->join_date = date('Y-m-d H:i:s',strtotime($request->join_date));
        $lawyer_details->resign_date = date('Y-m-d H:i:s',strtotime($request->resign_date));
        $lawyer_details->litigation_level = $request->litigation_level ;
        $lawyer_details->syndicate_level = $request->syndicate_level ;
        
        
        // $lawyer_plaintext = ClientsPasswords::where('user_id',$id)->first();
        // $lawyer_plaintext->password = $password;
        if($request->hasFile('authorization_copy')){
            $authorization_copy=$request->lawyer_name.time().rand(111,999).'.'.Input::file('authorization_copy')->getClientOriginalExtension();
            $destinationPath='lawyers_files/authorization_copy';
            Input::file('authorization_copy')->move($destinationPath, $authorization_copy);
            File::delete('lawyers_files/authorization_copy/'.$lawyer_details->authorization_copy);
            $lawyer_details->authorization_copy = $authorization_copy ;
        }

        if($request->hasFile('syndicate_copy')){
            $syndicate_copy=$request->lawyer_name.time().rand(111,999).'.'.Input::file('syndicate_copy')->getClientOriginalExtension();
            $destinationPath='lawyers_files/syndicate_copy';
            Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
            File::delete('lawyers_files/syndicate_copy/'.$lawyer_details->syndicate_copy);
            $lawyer_details->syndicate_copy = $syndicate_copy ;
        }
        $lawyer->user_detail()->save($lawyer_details);
        // $lawyer->client_password()->save($lawyer_plaintext);
        return redirect()->route('lawyers')->with('success','تم تعديل بيانات المحامى بنجاح');
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
