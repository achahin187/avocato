<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\User_Details;
use App\Tasks;
use App\Case_;
use App\Rules;
use App\Expenses;
use App\Geo_Countries;
use App\Entity_Localizations;
use App\ClientsPasswords;
use Validator;
use Helper;
use Excel;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Exports\LawyersExport;
use Jenssegers\Date\Date;
use App\Specializations;
use App\Geo_Cities;
use App\SyndicateLevels;
use App\OfficeBranches;


class OfficesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // if(session('country') == null)
    //     {
    //         return redirect()->route('choose.country');
    //     }
        // return Users::withTrashed()->restore();
  	/********/
    // $data['lawyers'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
    //   $q->where('rule_id', 5);
    // })->get();
    $q = Users::orderBy('id','DESC');
    $q->whereHas('rules', function ($q) {
          $q->where('rule_id', 15);
        });
    $data['offices'] = $q->get();
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
   // $data['types'] = Rules::where('parent_id', 5)->get();
    return view('offices.list', $data);
  }

  public function follow()
  {
    $data['lawyers'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
      $q->where('rule_id', 5);
    })->get();
    $data['test'] = json_encode([
      ['lat' => 30.042701, 'lang' => 31.432662],
      ['lat' => 30.036273, 'lang' => 31.432447],

    ]);
    return view('lawyers.lawyers_follow', $data);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    $data['types'] = Rules::where('parent_id', 5)->get();
    $data['work_sectors'] = Specializations::all();
    $data['work_sector_areas'] = Geo_Cities::where('country_id',session('country'))->get();
    $data['countries'] = Geo_Countries::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
    return view('offices.add', $data);
  }

  public function excel()
  {
    $filepath = 'public/excel/';
    $PathForJson = 'storage/excel/';
    $filename = 'lawyers' . time() . '.xlsx';
    if (isset($_GET['ids'])) {
      $ids = $_GET['ids'];
      Excel::store(new LawyersExport($ids), $filepath . $filename);
      return response()->json($PathForJson . $filename);
    } elseif ($_GET['filters'] != '') {
      $filters = json_decode($_GET['filters']);
      Excel::store((new LawyersExport($filters)), $filepath . $filename);
      return response()->json($PathForJson . $filename);
    } else {
      Excel::store((new LawyersExport()), $filepath . $filename);
      return response()->json($PathForJson . $filename);
    }
  }

  public function filter(Request $request)
  {
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
     */
    $data['lawyers'] = Users::where('country_id',session('country'))->where(function ($q) use ($request) {
      $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
      $date_to = date('Y-m-d 23:59:59', strtotime($request->date_to));

      if ($request->has('types') && $request->types != 0) {
        $q->whereHas('rules', function ($q) use ($request) {
          $q->where('rule_id', $request->types);

        });
      } else {
        $q->whereHas('rules', function ($q) {
          $q->where('rule_id', 5);
        });
      }
      if ($request->has('nationalities') && $request->nationalities != 0) {
        $q->whereHas('user_detail', function ($q) use ($request) {
          $q->where('nationality_id', $request->nationalities);

        });
      }

      if ($request->filled('work_sector')) {
        $q->whereHas('user_detail', function ($q) use ($request) {
          $q->where('work_sector', 'like', '%' . $request->work_sector . '%');

        });
      }

      if ($request->filled('syndicate_level')) {
        $q->whereHas('user_detail', function ($q) use ($request) {
          $q->where('syndicate_level', 'like', '%' . $request->syndicate_level . '%');

        });
      }

      if ($request->filled('date_from') && $request->filled('date_to')) {
        $q->whereHas('user_detail', function ($q) use ($request, $date_from, $date_to) {

          $q->whereBetween('join_date', array($date_from, $date_to));

        });
      } elseif ($request->filled('date_from')) {
        $q->whereHas('user_detail', function ($q) use ($request, $date_from) {

          $q->where('join_date', '>=', $date_from);

        });
      } elseif ($request->filled('date_to')) {
        $q->whereHas('user_detail', function ($q) use ($request, $date_to) {

          $q->where('join_date', '<=', $date_to);

        });
      }




    })->get();
    $data['roles'] = Rules::whereBetween('id', array('2', '4'))->get();
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    $data['types'] = Rules::whereBetween('id', array('11', '12'))->get();
    foreach ($data['lawyers'] as $lawyer) {
      $filter_ids[] = $lawyer->id;
    }
    if (!empty($filter_ids)) {
      Session::flash('filter_ids', $filter_ids);
    } else {
      $filter_ids[] = 0;
      Session::flash('filter_ids', $filter_ids);
    }

    return view('lawyers.lawyers', $data);

  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
   {
   	//dd($request);
   	// var_dump(count( $request->branches['branch_name']));die;
   
   //dd($request->branches[]);
  	 // foreach ($request->branches as $key => $branch) {
  	 // 	print_r($branch);
  	 // }
  	 // die;
    $validator = Validator::make($request->all(), [
      'office_name' => 'required',
      'office_email' => 'required|email',
      'office_phone' => 'required|digits_between:1,12|unique:users,mobile,,,deleted_at,NULL',
      // 'note' => 'required',
      // 'address' => 'required',
      // 'nationality' => 'required',
      // 'national_id' => 'required|numeric',
      // 'consultation_price' => 'required|numeric',
      // 'currency_id'=>'required',
      // 'birthdate' => 'required',
      // 'phone' => 'required|digits_between:1,10',
      // 'mobile' => 'required|digits_between:1,12',
      // 'email' => 'required|email|max:40',
      // 'image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
      // 'is_active' => 'required',
      // 'work_sector' => 'required',
      // 'work_sector_area' => 'required',
      // 'join_date' => 'required',
      // 'work_type' => 'required',
      // 'litigation_level' => 'required',
      // 'authorization_copy' => 'required|image|mimes:jpg,jpeg,png|max:1024',
      // 'syndicate_level_id' => 'required',
      // 'syndicate_copy' => 'required|image|mimes:jpg,jpeg,png|max:1024',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    if ($request->hasFile('office_image')) {
      $destinationPath = 'users_images';
      $office_image_name = $destinationPath . '/' . $request->office_name . time() . rand(111, 999) . '.' . Input::file('office_image')->getClientOriginalExtension();
      Input::file('office_image')->move($destinationPath, $office_image_name);
    }

    if ($request->hasFile('attorney_form')) {
      $destinationPath = 'lawyers_files/authorization_copy';
      $attorney_form = $destinationPath . '/' . $request->office_name . time() . rand(111, 999) . '.' . Input::file('attorney_form')->getClientOriginalExtension();
      Input::file('attorney_form')->move($destinationPath, $attorney_form);
    }
     //dd($attorney_form);


     if ($request->hasFile('rep_img')) {
      $destinationPath = 'users_images';
      $rep_img = $destinationPath . '/' . $request->rep_name . time() . rand(111, 999) . '.' . Input::file('rep_img')->getClientOriginalExtension();
      Input::file('rep_img')->move($destinationPath, $rep_img);
    }

     if ($request->hasFile('syndicate_copy')) {
      $destinationPath = 'lawyers_files/syndicate_copy';
      $syndicate_copy = $destinationPath . '/' . $request->rep_name . time() . rand(111, 999) . '.' . Input::file('syndicate_copy')->getClientOriginalExtension();
      Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
    }

   
    $office = new Users;
    $office->name = $request->office_name ;
    $office->full_name = $request->office_name;
    $office->address = $request->office_address;
    $office->phone = $request->office_phone;
    $office->mobile = $request->mobile;
    $office->email = $request->office_email;
    $office->is_active = $request->is_active;
    // $office->birthdate = date('Y-m-d H:i:s', strtotime($request->birthdate));
    $office->image = ($request->hasFile('office_image'))?$office_image_name:'';
    $office->country_id=session('country');
    $office->note = $request->note;
    $office->save();
    $office = Users::find($office->id);
    $password = Helper::generateRandom(Users::class, 'password', 8);
    $office->password = bcrypt($password);
    $office->code = Helper::generateRandom(Users::class, 'code', 6);
    $office->save();
    $office->rules()->attach([15,5]);  //needed later
    
    $office_details = new User_Details;
    $office_details->national_id = $request->national_id;
    $office_details->nationality_id = $request->nationality;
    // $lawyer_details->work_sector = $request->work_sector;
    $office_details->work_sector_area_id = $request->office_city;
    $office_details->experience = $request->experience;
    $office_details->consultation_price = $request->consultation_price;
    $office_details->currency_id = $request->currency_id;
    $office_details->is_international_arbitrator = $request->is_international_arbitrator;
    $office_details->international_arbitrator_specialization = $request->international_arbitrator_specialization;
    // $lawyer_details->join_date = date('Y-m-d H:i:s', strtotime($request->join_date));
    
    if ($request->filled('resign_date'))
      $office_details->resign_date = date('Y-m-d H:i:s', strtotime($request->resign_date));
    else
      $office_details->resign_date = null;

    $office_details->litigation_level = $request->litigation_level;
    $office_details->syndicate_level_id = $request->syndicate_level_id;
    $office_details->authorization_copy = ($request->hasFile('attorney_form'))?$attorney_form:'';
    $office_details->save();
    //dd($office_details->authorization_copy);
    $office_plaintext = new ClientsPasswords;
    $office_plaintext->password = $password;
    $office->user_detail()->save($office_details);
    $office->client_password()->save($office_plaintext);

    Helper::add_log(3, 19, $office->id);

    // process legal representative

    $representative = new Users;
    $representative->parent_id = $office->id;
    $representative->name = $request->rep_name . $representative->id;
    $representative->full_name = $request->rep_name;
    $representative->birthdate = date('Y-m-d H:i:s', strtotime($request->rep_birthdate));
    $representative->image = ($request->hasFile('rep_img'))?$rep_img:'';
    $representative->save();
    $representative = Users::find($representative->id);
    $password = Helper::generateRandom(Users::class, 'password', 8);
    $representative->password = bcrypt($password);
    $representative->code = Helper::generateRandom(Users::class, 'code', 6);
    $representative->save();
    // representative details
     $rep_details = new User_Details;
     $rep_details->user_id = $representative->id;
     $rep_details->national_id = $request->rep_nid;
     $rep_details->nationality_id = $request->rep_nationality;
     $rep_details->work_sector_area_id = $request->rep_spec;
     $rep_details->syndicate_copy = ($request->hasFile('syndicate_copy'))?$syndicate_copy:'';
     $rep_details->litigation_level = $request->rep_litigation_level;
     if($rep_details->save()){
      //representative specializations 
      $representative->specializations()->attach($request->specializations);
   
     }
     //process office Branches

     
     if(count($request->branches['branch_name']) != 0){ 
     	if(isset($request->branchNo)){
    $branchNo = $request->branchNo-1;
      }else{$branchNo=0;}
    for($i=0 ; $i<=$branchNo ;$i++){
     $branch = new OfficeBranches;
     $branch->office_id = $office->id;
     $branch->name = $request->branches['branch_name'][$i];
     $branch->address = $request->branches['branch_address'][$i];
     $branch->phone = $request->branches['branch_phone'][$i];
     $branch->email = $request->branches['branch_email'][$i];
     if(isset($request->branches['branch_country'][$i])){
     $branch->country_id = $request->branches['branch_country'][$i];}
      if(isset($request->branches['branch_city'][$i])){
     $branch->city_id = $request->branches['branch_city'][$i];}
     if(isset($request->branches['branch_name'][$i])){
     $branch->save();
     }
     }
     }
     
    return redirect()->route('offices_show', $office->id)->with('success', 'تم إضافه  مكتب جديد بنجاح');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //       $nas = Geo_Countries::where('id',2)->get();
    //       $s=$nas->flatMap(function ($values) {
    //       return array_map(function(){return 2;}, $values->toArray());
    // });
    //       return $s;

    $data['office'] = Users::find($id);
    $data['representative'] = Users::where('parent_id',$id )->first();
    $data['branches'] = OfficeBranches::where('office_id',$id)->get();
    if(OfficeBranches::where('office_id',$id)->count() == 0)
    	{$data['branches']=[];}

    if( $data['office'] == NULL ||  $data['representative'] == NULL ) {
      Session::flash('warning', 'المكنب غير  موجود');
      return redirect('/offices');
    } 

    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    Date::setLocale('ar');
    $tasks = Tasks::where('assigned_lawyer_id', $id)->get();
    if (count($tasks)) {

      foreach ($tasks as $task) {
        $tasks_months[Date::parse($task->start_datetime)->format('F')][] = [
          'id' => $task->id,
          'name' => $task->name,
          'start_datetime' => $task->start_datetime,
          'end_datetime' => $task->end_datetime,
          'task_type_id' => $task->task_type_id,
        ];
      }
    } else {
      $tasks_months = [];
    }
    $data['tasks_months'] = $tasks_months;
    $data['cases'] = Case_::whereHas('lawyers', function ($q) use ($id) {
      $q->where('lawyer_id', $id);
    })->get();

    $data['services'] = Tasks::where('task_type_id', 3)->where('assigned_lawyer_id', $id)->get();
    $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();
    $data['statuses'] = Entity_Localizations::where('entity_id', 4)->where('field', 'name')->get();
    $data['expenses'] = Expenses::where('lawyer_id', $id)->get();

    $data['rates_user'] = $data['office']->rate()->with('rules')->get();
    
    
    // dd($data['rates_user']);
    $data['rates'] = Entity_Localizations::where('entity_id', 10)->where('field', 'name')->get();
    $data['work_sector_areas'] = Geo_Cities::all();
    $data['countries'] = Geo_Countries::all();
    return view('offices.view', $data);
  }

  public function rate(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'date' => 'required',
      'rate' => 'required',
      'notes' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect('lawyers_show/' . $id . '#add_evaluation')
        ->withErrors($validator)
        ->withInput();
    }
    $date = date('Y-m-d H:i:s', strtotime($request->date));
    $office = Users::find($id);
    $office->rate()->attach(\Auth::user()->id, ['notes' => $request->notes, 'created_at' => $date, 'rate_id' => $request->rate]);
    return redirect()->route('lawyers_show', $id);


  }
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
  	$data['office'] = Users::find($id);
  	 $data['representative'] = Users::where('parent_id',$id )->with('specializations')->first();
    $data['branches'] = OfficeBranches::where('office_id',$id)->get();
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    $data['types'] = Rules::where('parent_id', 5)->get();
    $data['work_sectors'] = Specializations::all();
    $data['work_sector_areas'] = Geo_Cities::where('country_id',session('country'))->get();
    $data['countries'] = Geo_Countries::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
    return view('offices.edit', $data);
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
      'office_name' => 'required',
     
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    if ($request->hasFile('office_image')) {
      $destinationPath = 'users_images';
      $office_image_name = $destinationPath . '/' . $request->office_name . time() . rand(111, 999) . '.' . Input::file('office_image')->getClientOriginalExtension();
      Input::file('office_image')->move($destinationPath, $office_image_name);
    }

    if ($request->hasFile('attorney_form')) {
      $destinationPath = 'lawyers_files/authorization_copy';
      $attorney_form = $destinationPath . '/' . $request->office_name . time() . rand(111, 999) . '.' . Input::file('attorney_form')->getClientOriginalExtension();
      Input::file('attorney_form')->move($destinationPath, $attorney_form);
    }
     if ($request->hasFile('rep_img')) {
      $destinationPath = 'users_images';
      $rep_img = $destinationPath . '/' . $request->rep_name . time() . rand(111, 999) . '.' . Input::file('rep_img')->getClientOriginalExtension();
      Input::file('rep_img')->move($destinationPath, $rep_img);
    }

     if ($request->hasFile('syndicate_copy')) {
      $destinationPath = 'lawyers_files/syndicate_copy';
      $syndicate_copy = $destinationPath . '/' . $request->rep_name . time() . rand(111, 999) . '.' . Input::file('syndicate_copy')->getClientOriginalExtension();
      Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
    }

   
    $office =Users::where('id', $id)->first();
    $office->name = $request->office_name;
    $office->full_name = $request->office_name;
    $office->address = $request->office_address;
    $office->phone = $request->office_phone;
    $office->mobile = $request->mobile;
    $office->email = $request->office_email;
    $office->is_active = $request->is_active;
    $office->birthdate = date('Y-m-d H:i:s', strtotime($request->birthdate));
    $office->image = ($request->hasFile('office_image'))?$office_image_name:$office->image;
    $office->country_id=session('country');
    $office->note = $request->note;
    $office->save();
   
    $office_details =User_Details::where('user_id', $id)->first();
    $office_details->national_id = $request->national_id;
    $office_details->nationality_id = $request->nationality;
    // $lawyer_details->work_sector = $request->work_sector;
    $office_details->work_sector_area_id = $request->office_city;
    $office_details->experience = $request->experience;
    $office_details->consultation_price = $request->consultation_price;
    $office_details->currency_id = $request->currency_id;
    $office_details->is_international_arbitrator = $request->is_international_arbitrator;
    $office_details->international_arbitrator_specialization = $request->international_arbitrator_specialization;
    // $lawyer_details->join_date = date('Y-m-d H:i:s', strtotime($request->join_date));
    
    if ($request->filled('resign_date'))
      $office_details->resign_date = date('Y-m-d H:i:s', strtotime($request->resign_date));
    else
      $office_details->resign_date = null;

    $office_details->litigation_level = $request->litigation_level;
    $office_details->syndicate_level_id = $request->syndicate_level_id;
    $office_details->authorization_copy = ($request->hasFile('attorney_form'))?$attorney_form:$office_details->authorization_copy;
   $office_details->save();
  
    // process legal representative

    $representative =Users::where('parent_id',$office->id)->first();
    $representative->parent_id = $office->id;
    $representative->name = $request->rep_name;
    $representative->full_name = $request->rep_name;
    $representative->birthdate = date('Y-m-d H:i:s', strtotime($request->rep_birthdate));
    $representative->image = ($request->hasFile('rep_img'))?$rep_img:$representative->image;
    $representative->save();
    $representative = Users::find($representative->id);
    $password = Helper::generateRandom(Users::class, 'password', 8);
    $representative->password = bcrypt($password);
    $representative->code = Helper::generateRandom(Users::class, 'code', 6);
    $representative->save();
    // representative details
     $rep_details = User_Details::where('user_id', $representative->id)->first();
     $rep_details->user_id = $representative->id;
     $rep_details->national_id = $request->rep_nid;
     $rep_details->nationality_id = $request->rep_nationality;
     $rep_details->work_sector_area_id = $request->rep_spec;
     $rep_details->syndicate_copy = ($request->hasFile('syndicate_copy'))?$syndicate_copy:$rep_details->syndicate_copy;
     $rep_details->litigation_level = $request->rep_litigation_level;
     if($rep_details->save()){
      //representative specializations 
     	//remove old first
      $representative->specializations()->detach();
      //then add new
      $representative->specializations()->attach($request->specializations);
   
     }
     //process office Branches
     //delete old branches update with new
      OfficeBranches::where('office_id',$id )->delete();
   // $old_branches->delete();
    // $office->offices_branches()->delete();
     if(count($request->branches['branch_name']) != 0){ 
     	if(isset($request->branchNo)){
    $branchNo = $request->branchNo-1;
      }else{$branchNo=0;}
    for($i=0 ; $i<=$branchNo ;$i++){
     $branch = new OfficeBranches;
     $branch->office_id = $office->id;
     $branch->name = $request->branches['branch_name'][$i];
     $branch->address = $request->branches['branch_address'][$i];
     $branch->phone = $request->branches['branch_phone'][$i];
     $branch->email = $request->branches['branch_email'][$i];
     $branch->country_id = $request->branches['branch_country'][$i];
     $branch->city_id = $request->branches['branch_city'][$i];
     $branch->save();

     }
     }

    return redirect()->route('offices_show', $office->id)->with('success', 'تم إضافه  مكتب جديد بنجاح');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // public function destroyGet($id)
  // {
  //   Helper::add_log(5, 19, $id);
  //   $user = Users::find($id);
  //   $user->delete();
  //   return redirect()->route('lawyers')->with('success', 'تم حذف عضويه المحامى بنجاح');
  // }

  // public function destroyPost($id)
  // {
  //   Helper::add_log(5, 19, $id);
  //   $user = Users::find($id);
  //   $user->delete();
  // }

  // public function destroy_all()
  // {
  //   $ids = $_POST['ids'];
  //   foreach ($ids as $id) {
  //     Helper::add_log(5, 19, $id);
  //     $user = Users::find($id);
  //     $user->delete();
  //   }
  // }


  //create branch
 public function branch_create(Request $request)
  {
     
     $branch = new OfficeBranches;
     $branch->office_id = $request->office_id;
     $branch->name = $request->branch_name;
     $branch->address = $request->branch_address;
     $branch->phone = $request->branch_phone;
     $branch->email = $request->branch_email;
     $branch->country_id = $request->branch_country;
     $branch->city_id = $request->branch_city;
     $branch->save();    
    return redirect()->route('offices_show',  $request->office_id)->with('success', 'تم إضافه  فرعجديد بنجاح');

}

public function branch_edit(Request $request)
  { //dd($request->input());
     $id = $request->branch_id_edit;
     $branch = OfficeBranches::find($id);
     $branch->office_id = $request->office_id;
     $branch->name = $request->branch_name_edit;
     $branch->address = $request->branch_address_edit;
     $branch->phone = $request->branch_phone_edit;
     $branch->email = $request->branch_email_edit;
     $branch->country_id = $request->branch_country_edit;
     $branch->city_id = $request->branch_city_edit;
     $branch->save();    
    return redirect()->route('offices_show',  $request->office_id)->with('success', 'تم إضافه  فرعجديد بنجاح');

}

public function branch_destroy($id)
  {
    // Helper::add_log(5, 19, $id);
    $user = OfficeBranches::find($id);
    $user->delete();
  }

    public function destroyPost($id)
  {
    Helper::add_log(5, 21, $id);
    $user = Users::find($id);
    $user->delete();
  }

  public function get_cities($country_id)
  {
    return response()->json(Geo_Cities::where('country_id',$country_id)->get());
  }

}
