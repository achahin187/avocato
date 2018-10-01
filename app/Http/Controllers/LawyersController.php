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
use App\SyndicateLevels;


class LawyersController extends Controller
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
    $data['lawyers'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
      $q->where('rule_id', 5)->where('rule_id','!=',15);
    })->get();
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    $data['types'] = Rules::where('parent_id', 5)->get();
    $data['work_sectors'] = Specializations::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
    return view('lawyers.lawyers', $data);
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
    $data['work_sector_areas'] = Geo_Cities::all();
    $data['currencies'] = Geo_Countries::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
    return view('lawyers.lawyers_create', $data);
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
        $q->whereHas('specializations', function ($q) use ($request) {
          $q->whereIn('name',$request->work_sector);

        });
      }

      if ($request->filled('syndicate_level_id')) {
        $q->whereHas('user_detail', function ($q) use ($request) {
          $q->where('syndicate_level_id',$request->syndicate_level_id);

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
    $data['work_sectors'] = Specializations::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
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
    $validator = Validator::make($request->all(), [
      'lawyer_name' => 'required',
      'address' => 'required',
      'nationality' => 'required',
      'national_id' => 'required|numeric',
      'consultation_price' => 'required|numeric',
      'currency_id'=>'required',
      'birthdate' => 'required',
      'phone' => 'required|digits_between:1,10',
      'mobile' => 'required|digits_between:1,12',
      'email' => 'required|email|max:40',
      'image' => 'required|image|mimes:jpg,jpeg,png|max:1024',
      'is_active' => 'required',
      'work_sector' => 'required',
      'work_sector_area' => 'required',
      'join_date' => 'required',
      'work_type' => 'required',
      'litigation_level' => 'required',
      'authorization_copy' => 'required|image|mimes:jpg,jpeg,png|max:1024',
      'syndicate_level_id' => 'required',
      'syndicate_copy' => 'required|image|mimes:jpg,jpeg,png|max:1024',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }

    if ($request->hasFile('image')) {
      $destinationPath = 'users_images';
      $image_name = $destinationPath . '/' . $request->lawyer_name . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
      Input::file('image')->move($destinationPath, $image_name);
    }

    if ($request->hasFile('authorization_copy')) {
      $destinationPath = 'lawyers_files/authorization_copy';
      $authorization_copy = $destinationPath . '/' . $request->lawyer_name . time() . rand(111, 999) . '.' . Input::file('authorization_copy')->getClientOriginalExtension();
      Input::file('authorization_copy')->move($destinationPath, $authorization_copy);
    }

    if ($request->hasFile('syndicate_copy')) {
      $destinationPath = 'lawyers_files/syndicate_copy';
      $syndicate_copy = $destinationPath . '/' . $request->lawyer_name . time() . rand(111, 999) . '.' . Input::file('syndicate_copy')->getClientOriginalExtension();
      Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
    }

    $lawyer = new Users;
    $lawyer->name = $request->lawyer_name . $lawyer->id;
    $lawyer->full_name = $request->lawyer_name;
    $lawyer->address = $request->address;
    $lawyer->phone = $request->phone;
    $lawyer->mobile = $request->mobile;
    $lawyer->email = $request->email;
    $lawyer->is_active = $request->is_active;
    $lawyer->birthdate = date('Y-m-d H:i:s', strtotime($request->birthdate));
    $lawyer->image = $image_name;
    $lawyer->country_id=session('country');
    $lawyer->note = $request->note;
    $lawyer->save();
    $lawyer = Users::find($lawyer->id);
    $password = Helper::generateRandom(Users::class, 'password', 8);
    $lawyer->password = bcrypt($password);
    $lawyer->code = Helper::generateRandom(Users::class, 'code', 6);
    $lawyer->save();
    $lawyer->rules()->attach([5, $request->work_type]);
        foreach($request->work_sector as $work_sector)
    {
      $lawyer->specializations()->attach($work_sector);
    }
    $lawyer_details = new User_Details;
    $lawyer_details->national_id = $request->national_id;
    $lawyer_details->nationality_id = $request->nationality;
    // $lawyer_details->work_sector = $request->work_sector;
    $lawyer_details->work_sector_area_id = $request->work_sector_area;
    $lawyer_details->experience = $request->experience;
    $lawyer_details->consultation_price = $request->consultation_price;
    $lawyer_details->currency_id = $request->currency_id;
    $lawyer_details->is_international_arbitrator = $request->is_international_arbitrator;
    $lawyer_details->international_arbitrator_specialization = $request->international_arbitrator_specialization;
    $lawyer_details->join_date = date('Y-m-d H:i:s', strtotime($request->join_date));
    
    if ($request->filled('resign_date'))
      $lawyer_details->resign_date = date('Y-m-d H:i:s', strtotime($request->resign_date));
    else
      $lawyer_details->resign_date = null;

    $lawyer_details->litigation_level = $request->litigation_level;
    $lawyer_details->syndicate_level_id = $request->syndicate_level_id;
    $lawyer_details->authorization_copy = $authorization_copy;
    $lawyer_details->syndicate_copy = $syndicate_copy;
    $lawyer_plaintext = new ClientsPasswords;
    $lawyer_plaintext->password = $password;
    $lawyer->user_detail()->save($lawyer_details);
    $lawyer->client_password()->save($lawyer_plaintext);

    Helper::add_log(3, 19, $lawyer->id);

    return redirect()->route('lawyers_show', $lawyer->id)->with('success', 'تم إضافه محامي جديد بنجاح');

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

    $data['lawyer'] = Users::find($id);

    if( $data['lawyer'] == NULL ) {
      Session::flash('warning', 'العقد او الصيغة غير موجود');
      return redirect('/lawyers');
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

    $data['rates_user'] = $data['lawyer']->rate()->with('rules')->get();
    
    
    // dd($data['rates_user']);
    $data['rates'] = Entity_Localizations::where('entity_id', 10)->where('field', 'name')->get();
    return view('lawyers.lawyers_show', $data);
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
    $lawyer = Users::find($id);
    $lawyer->rate()->attach(\Auth::user()->id, ['notes' => $request->notes, 'created_at' => $date, 'rate_id' => $request->rate]);
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
    $data['lawyer'] = Users::find($id);

    if( $data['lawyer'] == NULL ) {
      Session::flash('warning', 'العقد او الصيغة غير موجود');
      return redirect('/lawyers');
    } 
    
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    $data['types'] = Rules::where('parent_id', 5)->get();
    $data['work_sectors'] = Specializations::all();
    $data['work_sector_areas'] = Geo_Cities::all();
    $data['currencies'] = Geo_Countries::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
    return view('lawyers.lawyers_edit', $data);
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
      'lawyer_name' => 'required',
      'address' => 'required',
      'nationality' => 'required',
      'consultation_price' => 'required|numeric',
      'currency_id'=>'required',
      'syndicate_level_id'=>'required',
      'work_sector_area' => 'required',
      'syndicate_level_id' => 'required',
      'national_id' => 'required|numeric',
      'birthdate' => 'required',
      'phone' => 'required|digits_between:1,10',
      'mobile' => 'required|digits_between:1,12',
      'email' => 'required|email|max:40',
      'is_active' => 'required',
      'work_sector' => 'required',
      'join_date' => 'required',
      'work_type' => 'required',
      'litigation_level' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }


    $lawyer = Users::find($id);
    $lawyer->name = $request->lawyer_name . $lawyer->id;
    $lawyer->full_name = $request->lawyer_name;
    $lawyer->address = $request->address;
    $lawyer->phone = $request->phone;
    $lawyer->mobile = $request->mobile;
    $lawyer->email = $request->email;
    $lawyer->note = $request->note;
    $lawyer->country_id=session('country');
    $lawyer->is_active = $request->is_active;
    $lawyer->birthdate = date('Y-m-d H:i:s', strtotime($request->birthdate));
    if ($request->hasFile('image')) {
      $destinationPath = 'users_images';
      $image_name = $destinationPath . '/' . $request->lawyer_name . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
      Input::file('image')->move($destinationPath, $image_name);
      File::delete($lawyer->image);
      $lawyer->image = $image_name;

    }

    $lawyer->save();
    $lawyer = Users::find($id);
        // $password = Helper::generateRandom(Users::class, 'password', 8);
        // $lawyer->password = bcrypt($password);
        // $lawyer->code = 'code-'.Helper::generateRandom(Users::class, 'code', 6);
    $lawyer->save();
    $lawyer->rules()->detach();
    $lawyer->rules()->attach([5, $request->work_type]);
    $lawyer->specializations()->detach();
          foreach($request->work_sector as $work_sector)
    {
      $lawyer->specializations()->attach($work_sector);
    }
    $lawyer_details = User_Details::where('user_id', $id)->first();;
    $lawyer_details->national_id = $request->national_id;
    $lawyer_details->nationality_id = $request->nationality;
    // $lawyer_details->work_sector = $request->work_sector;
    $lawyer_details->work_sector_area_id = $request->work_sector_area;
    $lawyer_details->experience = $request->experience;
    $lawyer_details->consultation_price = $request->consultation_price;
    $lawyer_details->currency_id = $request->currency_id;
    $lawyer_details->is_international_arbitrator = $request->is_international_arbitrator;
    $lawyer_details->international_arbitrator_specialization = $request->international_arbitrator_specialization;
    $lawyer_details->syndicate_level_id = $request->syndicate_level_id;

    $lawyer_details->join_date = date('Y-m-d H:i:s', strtotime($request->join_date));
    if ($request->filled('resign_date'))
      $lawyer_details->resign_date = date('Y-m-d H:i:s', strtotime($request->resign_date));
    else
      $lawyer_details->resign_date = null;

    $lawyer_details->litigation_level = $request->litigation_level;
    $lawyer_details->syndicate_level = $request->syndicate_level;


        // $lawyer_plaintext = ClientsPasswords::where('user_id',$id)->first();
        // $lawyer_plaintext->password = $password;
    if ($request->hasFile('authorization_copy')) {
      $destinationPath = 'lawyers_files/authorization_copy';
      $authorization_copy = $destinationPath . '/' . $request->lawyer_name . time() . rand(111, 999) . '.' . Input::file('authorization_copy')->getClientOriginalExtension();
      Input::file('authorization_copy')->move($destinationPath, $authorization_copy);
      File::delete($lawyer_details->authorization_copy);
      $lawyer_details->authorization_copy = $authorization_copy;
    }

    if ($request->hasFile('syndicate_copy')) {
      $destinationPath = 'lawyers_files/syndicate_copy';
      $syndicate_copy = $destinationPath . '/' . $request->lawyer_name . time() . rand(111, 999) . '.' . Input::file('syndicate_copy')->getClientOriginalExtension();
      Input::file('syndicate_copy')->move($destinationPath, $syndicate_copy);
      File::delete($lawyer_details->syndicate_copy);
      $lawyer_details->syndicate_copy = $syndicate_copy;
    }
    $lawyer->user_detail()->save($lawyer_details);
        // $lawyer->client_password()->save($lawyer_plaintext);
    
    Helper::add_log(4, 19, $lawyer->id);
    return redirect()->route('lawyers')->with('success', 'تم تعديل بيانات المحامى بنجاح');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroyGet($id)
  {
    Helper::add_log(5, 19, $id);
    $user = Users::find($id);
    $user->delete();
    return redirect()->route('lawyers')->with('success', 'تم حذف عضويه المحامى بنجاح');
  }

  public function destroyPost($id)
  {
    Helper::add_log(5, 19, $id);
    $user = Users::find($id);
    $user->delete();
  }

  public function destroy_all()
  {
    $ids = $_POST['ids'];
    foreach ($ids as $id) {
      Helper::add_log(5, 19, $id);
      $user = Users::find($id);
      $user->delete();
    }
  }
}
