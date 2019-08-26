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
    $q = Users::orderBy('id','DESC')->where('country_id',session('country'));
    $q->whereHas('rules', function ($q) {
          $q->where('rule_id', 15);
        });
    $data['offices'] = $q->with(['user_detail'=>function($w){$w->select('work_sector_area_id','user_id');}])->paginate(10);
    $data['cities'] = Geo_Cities::where('country_id',session('country'))->get();
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
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
    $data['codes']=Geo_Countries::all();
    $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    $data['types'] = Rules::where('parent_id', 5)->get();
    $data['work_sectors'] = Specializations::all();
    $data['work_sector_areas'] = Geo_Cities::where('country_id',session('country'))->get();
    $data['countries'] = Geo_Countries::all();
    $data['syndicate_levels'] = SyndicateLevels::all();
    return view('offices.add', $data);
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
      if($request->has('search'))
      {
        $q->where('name','like','%'.$request->search.'%')->orwhere('full_name','like','%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%')->orwhere('cellphone','like','%'.$request->search.'%');
      }
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

    })->paginate(10);
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
   //  dd($request->all());
     //data validation
      $validator = Validator::make($request->all(), [
      'office_name' => 'required',
      'office_email' => 'required|email',
      'tele_code'=>'required',
      'office_cellphone' => (session('country') == 1)?'required|digits:10|unique:users,cellphone,,,deleted_at,NULL':'required|digits:9|unique:users,cellphone,,,deleted_at,NULL',
       'branches' => 'required',
      // 'office_city' => 'required',
      'rep_name' => 'required',
      'rep_birthdate' => 'required|date',
      'rep_nid' => 'required',
      'rep_nationality' => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
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
    
    //get current country id
    $country = Session::get('country');
    // if($country == 1){ //Egypt
    //   $office_phone = '+2'.$request->office_phone;   
    // }else{//Saudi Arabia
    //   $office_phone = '+966'.$request->office_phone;
    // }

    $office = new Users;
    $office->name = $request->office_name ;
    $office->full_name = $request->office_name;
    $office->address = $request->office_address;
    // $office->phone = $request->phone;
    $office->tele_code = $request->tele_code ;
    $office->cellphone = $request->office_cellphone ;
    $office->mobile = $request->tele_code.$request->office_cellphone ;
    $office->email = $request->office_email;
    $office->is_active = $request->is_active;
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
    $office_details->work_sector_area_id = $request->office_city;
    $office_details->experience = $request->experience;
    $office_details->consultation_price = $request->consultation_price;
    $office_details->currency_id = $request->currency_id;
    $office_details->is_international_arbitrator = $request->is_international_arbitrator;
    $office_details->international_arbitrator_specialization = $request->international_arbitrator_specialization;
     
    if ($request->filled('resign_date')){
      $office_details->resign_date = date('Y-m-d H:i:s', strtotime($request->resign_date));
    }
    else{
      $office_details->resign_date = null;
    }

    $office_details->litigation_level = $request->litigation_level;
    $office_details->syndicate_level_id = $request->syndicate_level_id;
    $office_details->authorization_copy = ($request->hasFile('attorney_form'))?$attorney_form:'';
    $office_details->save();
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
      $representative->specializations()->attach($request->specializations);
   
     }
   
    //process office Branches
    if(count($request->branches['branch_name']) != 0){ 
        if(isset($request->branchNo)){
            $branchNo = $request->branchNo-1;
        }else{
            $branchNo=0;
        }
        for($i=0 ; $i<=$branchNo ;$i++){
            $branch = new OfficeBranches;
            $branch->office_id = $office->id;
            $branch->name = $request->branches['branch_name'][$i];
            $branch->address = $request->branches['branch_address'][$i];
            $branch->phone = $request->branches['branch_phone'][$i];
            $branch->email = $request->branches['branch_email'][$i];
            if( isset($request->branches['branch_country'][$i]) ){
              $branch->country_id = $request->branches['branch_country'][$i];
            }
            if( isset($request->branches['branch_city'][$i]) ){
              $branch->city_id = $request->branches['branch_city'][$i];
            }
            if( isset($request->branches['branch_name'][$i]) ){
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
      foreach($data['branches'] as $key=>$branch)
      {
        if($branch['country_id'] != null)
        {
          if($branch['city_id'] != null)
          {
            $data['branches'][$key]['cities']=Geo_Cities::where('country_id',$branch['country_id'])->get();
          }
          else
          {
            $data['branches'][$key]['cities']=[];
          }
        }
        else
        {
          $data['branches'][$key]['cities']=[];
        }
      }
      $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
      $data['types'] = Rules::where('parent_id', 5)->get();
      $data['work_sectors'] = Specializations::all();
      $data['work_sector_areas'] = Geo_Cities::where('country_id',session('country'))->get();
      $data['countries'] = Geo_Countries::all();
      $data['syndicate_levels'] = SyndicateLevels::all();
      $data['client_password'] = ClientsPasswords::where('user_id',$id)->first();
      $data['codes']=Geo_Countries::all();
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
    
    $user = Users::find($id);
    $validator = Validator::make($request->all(), [
        'office_name' => 'required',
        'tele_code'=>'required',
        'office_cellphone' => ($user->cellphone == $request['office_cellphone'])? "":((session('country')==1)?"unique:users,cellphone,,,deleted_at,NULL|digits:10":"unique:users,cellphone,,,deleted_at,NULL|digits:9"),
        'office_email' => ($user->email == $request['office_email'])? "email":"bail|email|unique:users,email,,,deleted_at,NULL",
        // 'office_city' => 'required',
        'rep_name' => 'required',
        'rep_birthdate' => 'required|date',
        'rep_nid' => 'required',
        'rep_nationality' => 'required',
    ]);

    if ($validator->fails()) {
      // dd($validator);
      return redirect()->back()->withErrors($validator)->withInput();
    }

    if ($request->hasFile('office_image')) {
      $destinationPath = 'users_images';
      $office_image_name = $destinationPath . '/'. time() . rand(111, 999) . '.' . Input::file('office_image')->getClientOriginalExtension();
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

    //get current country id
    $country = Session::get('country');
    
    $office = Users::where('id', $id)->first();
    $office->name = $request->office_name;
    $office->full_name = $request->office_name;
    $office->address = $request->office_address;
    $office->tele_code = $request->tele_code ;
    $office->cellphone = $request->office_cellphone ;
    $office->mobile = $request->tele_code.$request->office_cellphone;
    // $office->mobile = $request->mobile;
    $office->email = $request->office_email;
    $office->is_active = $request->is_active;
    $office->birthdate = date('Y-m-d H:i:s', strtotime($request->rep_birthdate));
    $office->image = ($request->hasFile('office_image')) ? $office_image_name : $office->image;
    $office->country_id = session('country');
    $office->note = $request->note;
    $office->save();
   
    $office_details =User_Details::where('user_id', $id)->first();
    
    if($office_details){
      
      $office_details->national_id = $request->rep_nid;
      $office_details->nationality_id = $request->rep_nationality;
      $office_details->work_sector_area_id = $request->office_city;
      $office_details->experience = $request->experience;
      $office_details->consultation_price = $request->consultation_price;
      $office_details->currency_id = $request->currency_id;
      $office_details->is_international_arbitrator = $request->is_international_arbitrator;
      $office_details->international_arbitrator_specialization = $request->international_arbitrator_specialization;
      
      if ($request->filled('resign_date'))
        $office_details->resign_date = date('Y-m-d H:i:s', strtotime($request->resign_date));
      else{
        $office_details->resign_date = null;
      }
      $office_details->litigation_level = $request->litigation_level;
      $office_details->syndicate_level_id = $request->syndicate_level_id;
      $office_details->authorization_copy = ($request->hasFile('attorney_form'))?$attorney_form:$office_details->authorization_copy;
      $office_details->save();
    }

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
 
      // return $request->branches;
    //  return $request->branchNo;
      if($request->branches){
       
        if(count($request->branches['branch_name']) != 0){ 

            if(isset($request->branchNo)){
              $branchNo = $request->branchNo-1;
            }else{
              $branchNo=0;
            }

            // return $branchNo;
            for($i=0 ; $i<=$branchNo ;$i++){

                $branch = new OfficeBranches;
                $branch->office_id = $office->id;
                $branch->name = (isset($request->branches['branch_name'][$i])) ? $request->branches['branch_name'][$i] : null;
                $branch->address = (isset($request->branches['branch_address'][$i])) ? $request->branches['branch_address'][$i] : null;
                $branch->phone = (isset($request->branches['branch_phone'][$i])) ? $request->branches['branch_phone'][$i] : null;
                $branch->email = (isset($request->branches['branch_email'][$i])) ? $request->branches['branch_email'][$i] : null;
                $branch->country_id = (isset($request->branches['branch_country'][$i])) ? $request->branches['branch_country'][$i] : null;
                $branch->city_id = (isset($request->branches['branch_city'][$i])) ? $request->branches['branch_city'][$i] : null;
                $branch->save();
            }
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

  //create branch
 public function branch_create(Request $request)
  {
    $validator = Validator::make($request->all() ,[
        'office_id' => 'required',
        'branch_name' => 'required',
        'branch_address' => 'required',
        'branch_country' => 'required',
        'branch_city' => 'required',
        'branch_phone' => 'required|digits_between:1,15'
    ]);

    if($validator->fails()){
      return redirect('offices_show/'.$request->office_id.'#add_branch')->withErrors($validator)->withInput();
    }

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
{
    $validator = Validator::make($request->all() ,[
        'office_id' => 'required',
        'branch_name_edit' => 'required',
        'branch_address_edit' => 'required',
        'branch_country_edit' => 'required',
        'branch_city_edit' => 'required',
        'branch_phone_edit' => 'required|digits_between:1,15'
    ]);

    if($validator->fails()){
      return redirect('offices_show/'.$request->office_id.'#edit_branch')->withErrors($validator)->withInput();
    }
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
    return redirect()->route('offices_show',  $request->office_id)->with('success', 'تم إضافه  فرع جديد بنجاح');

}

  public function branch_destroy($id)
  {
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
  
  public function cityFilter(Request $request){
    
    if(isset($request->office_city) || isset($request->search)){
       
        $q = Users::where('country_id',session('country'));
        if($request->has('search'))
        {
          $q = $q->where('name','like','%'.$request->search.'%')->orwhere('full_name','like','%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%')->orwhere('cellphone','like','%'.$request->search.'%');
        }
    
        if($request->has('office_city'))
        {
       $q = $q->whereHas('user_detail',function($q) use ($request) {
        $q->where('work_sector_area_id',$request->office_city);
    }); 

      $q=$q->orderBy('id','DESC');
  }   
     
     $data['offices'] = $q->whereHas('rules', function ($query) {
      $query->where('id', 15);
      $query->where('parent_id','!=',5);
    })->with('rules')->paginate(10);
     $data['cities'] = Geo_Cities::where('country_id',session('country'))->get();
     $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
    dd($data['offices']);
    return view('offices.list', $data);
      
    }else if($request->office_city == null && $request->search == null){
      return redirect()->route('offices');
    }     
 
  }


  // public function excel()
  // {
  //   $filepath = 'public/excel/';
  //   $PathForJson = 'storage/excel/';
  //   $filename = 'lawyers' . time() . '.xlsx';
  //   if (isset($_GET['is_report'])) {
  //     $is_report = $_GET['is_report'];
  //   }else{
  //     $is_report = null; 
  //   }
    
    
  //   if (isset($_GET['ids'])) {
  //     $ids = $_GET['ids'];
  //     Excel::store(new LawyersExport($ids , $is_report), $filepath . $filename);
  //     return response()->json($PathForJson . $filename);
  //   } elseif ($_GET['filters'] != '') {
  //     $filters = json_decode($_GET['filters']);
  //     Excel::store((new LawyersExport($filters , $is_report)), $filepath . $filename);
  //     return response()->json($PathForJson . $filename);
  //   } else {
  //     Excel::store((new LawyersExport(null , $is_report)), $filepath . $filename);
  //     return response()->json($PathForJson . $filename);
  //   }
  // }

}
