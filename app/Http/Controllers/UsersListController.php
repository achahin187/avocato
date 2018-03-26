<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Users;
use App\Rules;
use App\Users_Rules;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Excel;
use Session;

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
        $data['roles']=Rules::whereBetween('id',array('2','4'))->get();
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


    public function excel()
    {   
        $usersArray[]=['رقم','اسم الموظف','البريد الإلكترونى','نوع العضويه','هاتف','فعال','تاريخ التسجيل','آخر مشاركه'];
        if(isset($_GET['ids'])){
           $ids = $_GET['ids'];
           foreach($ids as $id)
           {
            $user = Users::find($id,['id','name','email','phone','is_active','created_at','last_login']);
            if($user->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($user->rules as $rule){
                if($rule->id!=13)
                    $role=$rule->name_ar;
            }
            $usersArray[] = array(
                'id' => $user->id ,
                'name' => $user->name ,
                'email' => $user->email,
                'role'=>$role,
                'phone' => $user->phone,
                'is_active'=> $is_active,
                'created_at' => $user->created_at,
                'last_login'=>$user->last_login
            );
        }    
    }
    elseif($_GET['filters']!=''){
       $filters = json_decode($_GET['filters']);
       foreach($filters as $filter)
       {
        $user = Users::find($filter,['id','name','email','phone','is_active','created_at','last_login']);
            if($user->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($user->rules as $rule){
                if($rule->id!=13)
                    $role=$rule->name_ar;
            }
            $usersArray[] = array(
                'id' => $user->id ,
                'name' => $user->name ,
                'email' => $user->email,
                'role'=>$role,
                'phone' => $user->phone,
                'is_active'=> $is_active,
                'created_at' => $user->created_at,
                'last_login'=>$user->last_login
            );
    }    
}
else{
    $users = Users::whereHas('rules', function($q){
        $q->whereIn('name',['super admin','admin','data entry','call center']);
    })->get();
    foreach($users as $user){
        if($user->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($user->rules as $rule){
                if($rule->id!=13)
                    $role=$rule->name_ar;
            }
            $usersArray[] = array(
                'id' => $user->id ,
                'name' => $user->name ,
                'email' => $user->email,
                'role'=>$role,
                'phone' => $user->phone,
                'is_active'=> $is_active,
                'created_at' => $user->created_at,
                'last_login'=>$user->last_login
            );
  }   
}

        $myFile= Excel::create('المستخدمين', function($excel) use($usersArray) {
                            // Set the title
            $excel->setTitle('المستخدمين');

                            // Chain the setters
            $excel->setCreator('PentaValue')
            ->setCompany('PentaValue');
                            // Call them separately
            $excel->setDescription('بيانات ما تم اختياره من جدول المستخدمين');

            $excel->sheet('المستخدمين', function($sheet) use($usersArray) {
                $sheet->setRightToLeft(true); 
                $sheet->getStyle( "A1:H1" )->getFont()->setBold( true );
                        // $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                        // $sheet->cell('B1', function($cell) {$cell->setValue('Last ');   });
                        // $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });           
                $sheet->fromArray($usersArray, null, 'A1', false, false);

            });
});
        $myFile = $myFile->string('xlsx'); ////change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "المستخدمين".date('Y_m_d'), //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
       );
        return response()->json($response);
    }

        public function filter(Request $request){
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
             */
             $data['users'] = Users::where(function($q) use($request){
            $date_from=date('Y-m-d H:i:s',strtotime($request->date_from));
            $date_to=date('Y-m-d 23:59:59',strtotime($request->date_to));

            if($request->has('roles'))
            {
               $q->whereHas('rules',function($q) use($request){
                $q->whereIn('name',$request->roles);

            });  
           }
           else{
              $q->whereHas('rules', function($q){
                $q->whereIn('name',['admin','data entry','call center']);
            });  
          }

            if($request->filled('date_from') && $request->filled('date_to') )
            {
                $q->whereBetween('last_login', array($date_from, $date_to));
            }
            elseif($request->filled('date_from'))
            {
                $q->where('last_login','>=',$date_from);
            }
            elseif($request->filled('date_to'))
            {
                $q->where('last_login','<=',$date_to);
            }
            if($request->active == 1 || $request->active == 0 )
            {
                $q->where('is_active',$request->active);
            }



     })->get();
        $data['roles']=Rules::whereBetween('id',array('2','4'))->get();
        foreach($data['users'] as $user)
        {
            $filter_ids[]=$user->id;
        }
        if(!empty($filter_ids))
        {
                    Session::flash('filter_ids',$filter_ids);
        }
        else{
            $filter_ids[]=0;
            Session::flash('filter_ids',$filter_ids);
        }

        return view('users.users_list',$data);
        
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
        $data['user']=Users::find($id);
        return view('users.user_profile',$data);
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
    public function destroyGet($id)
    {
        // return Users::withTrashed()->restore();
        $user = Users::find($id);
        $user->delete();
        return redirect()->route('users_list')->with('success','تم حذف العضويه بنجاح');
    }

        public function destroyPost($id)
    {
        $user = Users::find($id);
        $user->delete();
        return redirect()->route('users_list')->with('success','تم حذف العضويه بنجاح');
    }

        public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            Users::find($id)->delete();
        } 
    }
}