<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Users;
use App\Rules;
use App\Users_Rules;
use Illuminate\Support\Facades\Input;

class UsersListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['users'] = Users::whereHas('rules', function($q){
        $q->whereIn('name',['super admin','admin','data entry','call center']);
    })->get();
        return view('users.users_list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $data['roles']=Rules::whereBetween('id',array('2','4'))->get();
        return view('users.users_list_create',$data);
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
            'user_name'=>'required|between:3,20|unique:users,name',
            'full_name'=>'required|between:3,100',
            'role'=>'required',
            'email'=>'required|email|max:40',
            'phone'=>'required|digits_between:1,10',
            'mobile'=>'required|digits_between:1,12',
            'password'=>'required|between:3,8|same:confirm_password',
            'confirm_password'=>'required|between:3,8|same:confirm_password',
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = new Users;
        $user->name= $request->user_name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->is_active = '1';
        $user->password = bcrypt($request->password) ;
        if($request->hasFile('image')){
            $fileNameToStore=$request->user_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            $destinationPath='users_images';
            // dd($fileNameToStore);
            Input::file('image')->move($destinationPath,$fileNameToStore);
        }
        else
        {
            $fileNameToStore="male.jpg";
        }
        $user->image=$fileNameToStore;
        $user->save();
        $user->rules()->attach([$request->role,13]);
        return redirect()->route('users_list_create')->with('success','تم إضافه مستخدم جديد بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.user_profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user']=Users::find($id);
        $data['roles']=Rules::whereBetween('id',array('2','4'))->get();
        return view('users.users_list_edit',$data);
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
            'user_name'=>'required|between:3,20|unique:users,name,'.$id,
            'full_name'=>'required|between:3,100',
            'role'=>'required',
            'email'=>'required|email|max:40',
            'phone'=>'required|digits_between:1,10',
            'mobile'=>'required|digits_between:1,12',
            'password'=>'required|between:3,8|same:confirm_password',
            'confirm_password'=>'required|between:3,8|same:confirm_password',
            'image'=>'image|mimes:jpg,jpeg,png|max:1024',
            'is_active'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
        $user = Users::find($id);
        $user->name= $request->user_name;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->mobile = $request->mobile;
        $user->is_active = $request->is_active;
        $user->password = bcrypt($request->password) ;
        if($request->hasFile('image')){
            $fileNameToStore=$request->user_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            if($user->image!='male.jpg'){
            File::delete('users_images/'.$user->image);    
            }
            $destinationPath='users_images';
            Input::file('image')->move($destinationPath,$fileNameToStore);
        }
        else{
            if($user->image!='male.jpg'){
            $destinationPath='users_images';
            $fileNameToStore=$request->user_name.time().rand(111,999).'.'.substr($user->image, strrpos($user->image, '.')+1);
            rename(public_path($destinationPath.'/'.$user->image), public_path($destinationPath.'/'.$fileNameToStore));    
            }
            else{
                $fileNameToStore='male.jpg';
            }

        }
        $user->image=$fileNameToStore;
        $user->save();
        $user->rules()->detach();
        $user->rules()->attach([$request->role,13]);
        return redirect()->route('users_list')->with('success','تم تعديل بيانات العضويه بنجاح');
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
