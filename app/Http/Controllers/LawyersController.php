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
use Excel;
use Session;
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
        // return Users::withTrashed()->restore();
        $data['lawyers'] = Users::whereHas('rules', function($q){
            $q->where('rule_id',5);
        })->get();
        $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
        $data['types']=Rules::where('parent_id',5)->get();
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
        $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
        $data['types']=Rules::where('parent_id',5)->get();
        return view('lawyers.lawyers_create',$data);
    }

    public function excel()
    {   
        $lawyersArray[]=['كود المحامي','الإسم','نوع العمل','الرقم القومى','التخصص','درجه القيد بالنقابه','عنوان','رقم الموبايل','تاريخ الإلتحاق','الجنسيه','تفعيل'];
        if(isset($_GET['ids'])){
           $ids = $_GET['ids'];
           foreach($ids as $id)
           {
            $lawyer = Users::find($id);
            if($lawyer->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($lawyer->rules as $rule){
                if($rule->id!=13)
                    $role=$rule->name_ar;
            }
            $nationality=Helper::localizations('geo_countries','nationality',$lawyer->user_detail->nationality_id);
            $lawyersArray[] = array(
                'code' => $lawyer->id ,
                'name' => $lawyer->name ,
                'type' => $role,
                'national_id' => $lawyer->user_detail->national_id,
                'work_sector' => $lawyer->user_detail->work_sector,
                'syndicate_level' => $lawyer->user_detail->syndicate_level,
                'address' => $lawyer->address ,
                'mobile' => $lawyer->mobile,
                'join_date' => $lawyer->user_detail->join_date,
                'nationality'=> $nationality,
                'is_active'=> $is_active,
            );
        }    
    }
    elseif($_GET['filters']!=''){
     $filters = json_decode($_GET['filters']);
     foreach($filters as $filter)
     {
        $lawyer = Users::find($filter);
        if($lawyer->is_active)
        {
            $is_active='فعال';
        }
        else{
            $is_active='غير فعال';
        }
        foreach($lawyer->rules as $rule){
            if($rule->id!=13)
                $role=$rule->name_ar;
        }
        $nationality=Helper::localizations('geo_countries','nationality',$lawyer->user_detail->nationality_id);
        $lawyersArray[] = array(
            'code' => $lawyer->id ,
            'name' => $lawyer->name ,
            'type' => $role,
            'national_id' => $lawyer->user_detail->national_id,
            'work_sector' => $lawyer->user_detail->work_sector,
            'syndicate_level' => $lawyer->user_detail->syndicate_level,
            'address' => $lawyer->address ,
            'mobile' => $lawyer->mobile,
            'join_date' => $lawyer->user_detail->join_date,
            'nationality'=> $nationality,
            'is_active'=> $is_active,
        );
    }  
}
else{
    $lawyers = Users::whereHas('rules', function($q){
        $q->whereIn('rule_id',[11,12]);
    })->get();
    foreach($lawyers as $lawyer){

    }
    foreach($lawyers as $lawyer){
        $value=Helper::localizations('geo_countries','nationality',$lawyer->user_detail->nationality_id);
        $lawyer['nationality']=$value;
        if($lawyer->is_active)
        {
            $is_active='فعال';
        }
        else{
            $is_active='غير فعال';
        }
        foreach($lawyer->rules as $rule){
            if($rule->id!=13)
                $role=$rule->name_ar;
        }
        $lawyersArray[] = array(
            'code' => $lawyer->id ,
            'name' => $lawyer->name ,
            'type' => $role,
            'national_id' => $lawyer->user_detail->national_id,
            'work_sector' => $lawyer->user_detail->work_sector,
            'syndicate_level' => $lawyer->user_detail->syndicate_level,
            'address' => $lawyer->address ,
            'mobile' => $lawyer->mobile,
            'join_date' => $lawyer->user_detail->join_date,
            'nationality'=> $lawyer->nationality,
            'is_active'=> $is_active,
        );
    }   
}

$myFile= Excel::create('الساده المحامين', function($excel) use($lawyersArray) {
                            // Set the title
    $excel->setTitle('الساده المحامين');

                            // Chain the setters
    $excel->setCreator('PentaValue')
    ->setCompany('PentaValue');
                            // Call them separately
    $excel->setDescription('بيانات ما تم اختياره من جدول الساده المحامين');

    $excel->sheet('الساده المحامين', function($sheet) use($lawyersArray) {
        $sheet->setRightToLeft(true); 
        $sheet->getStyle( "A1:k1" )->getFont()->setBold( true );
                        // $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                        // $sheet->cell('B1', function($cell) {$cell->setValue('Last ');   });
                        // $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });           
        $sheet->fromArray($lawyersArray, null, 'A1', false, false);

    });
});
        $myFile = $myFile->string('xlsx'); ////change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "الساده المحامين".date('Y_m_d'), //no extention needed
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
            $data['lawyers'] = Users::where(function($q) use($request){
                $date_from=date('Y-m-d H:i:s',strtotime($request->date_from));
                $date_to=date('Y-m-d 23:59:59',strtotime($request->date_to));

                if($request->has('types') && $request->types != 0)
                {
                   $q->whereHas('rules',function($q) use($request){
                    $q->where('rule_id',$request->types);

                });  
               }
               else{
                  $q->whereHas('rules', function($q){
                    $q->where('rule_id',5);
                });  
              }
              if($request->has('nationalities') && $request->nationalities !=0)
              {
                   $q->whereHas('user_detail',function($q) use($request){
                    $q->where('nationality_id',$request->nationalities);

                });  
                }

                if($request->filled('work_sector'))
              {
                   $q->whereHas('user_detail',function($q) use($request){
                    $q->where('work_sector','like','%'.$request->work_sector.'%');

                });  
                }

                 if($request->filled('syndicate_level'))
              {
                   $q->whereHas('user_detail',function($q) use($request){
                    $q->where('syndicate_level','like','%'.$request->syndicate_level.'%');

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




        })->get();
            $data['roles']=Rules::whereBetween('id',array('2','4'))->get();
            $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
            $data['types']=Rules::whereBetween('id',array('11','12'))->get();
            foreach($data['lawyers'] as $lawyer)
            {
                $filter_ids[]=$lawyer->id;
            }
            if(!empty($filter_ids))
            {
                Session::flash('filter_ids',$filter_ids);
            }
            else{
                $filter_ids[]=0;
                Session::flash('filter_ids',$filter_ids);
            }

            return view('lawyers.lawyers',$data);

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
            $destinationPath='users_images';
            $image_name = $destinationPath.'/'.$request->lawyer_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move($destinationPath, $image_name);
        }

        if($request->hasFile('authorization_copy')){
            $destinationPath='lawyers_files/authorization_copy';
            $authorization_copy = $destinationPath.'/'.$request->lawyer_name.time().rand(111,999).'.'.Input::file('authorization_copy')->getClientOriginalExtension();
            Input::file('authorization_copy')->move($destinationPath, $authorization_copy);
        }

        if($request->hasFile('syndicate_copy')){
            $destinationPath='lawyers_files/syndicate_copy';
            $syndicate_copy = $destinationPath.'/'.$request->lawyer_name.time().rand(111,999).'.'.Input::file('syndicate_copy')->getClientOriginalExtension();
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
        $lawyer->rules()->attach([5,$request->work_type]);
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
    public function show($id)
    {
       $data['lawyer'] = Users::find($id);
       $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
        return view('lawyers.lawyers_show',$data);
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
        $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
        $data['types'] = Rules::where('parent_id',5)->get();
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
            $destinationPath='users_images';
            $image_name = $destinationPath.'/'.$request->lawyer_name.time().rand(111,999).'.'.Input::file('image')->getClientOriginalExtension();
            Input::file('image')->move($destinationPath, $image_name);
            File::delete($lawyer->image);
            $lawyer->image = $image_name;

        }

        $lawyer->save();
        $lawyer=Users::find($id);
        // $password = Helper::generateRandom(Users::class, 'password', 8);
        // $lawyer->password = bcrypt($password);
        // $lawyer->code = 'code-'.Helper::generateRandom(Users::class, 'code', 6);
        $lawyer->save();
        $lawyer->rules()->detach();
        $lawyer->rules()->attach([5,$request->work_type]);
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
            $destinationPath='lawyers_files/authorization_copy';
            $authorization_copy = $destinationPath.'/'.$request->lawyer_name.time().rand(111,999).'.'.Input::file('authorization_copy')->getClientOriginalExtension();
            Input::file('authorization_copy')->move($destinationPath, $authorization_copy);
            File::delete($lawyer_details->authorization_copy);
            $lawyer_details->authorization_copy = $authorization_copy ;
        }

        if($request->hasFile('syndicate_copy')){
            $destinationPath='lawyers_files/syndicate_copy';
            $syndicate_copy = $destinationPath.'/'.$request->lawyer_name.time().rand(111,999).'.'.Input::file('syndicate_copy')->getClientOriginalExtension();
            Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
            File::delete($lawyer_details->syndicate_copy);
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
    public function destroyGet($id)
    {
        // return Users::withTrashed()->restore();
        $user = Users::find($id);
        $user->delete();
        return redirect()->route('lawyers')->with('success','تم حذف عضويه المحامى بنجاح');
    }

    public function destroyPost($id)
    {
        $user = Users::find($id);
        $user->delete();
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
