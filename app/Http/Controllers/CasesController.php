<?php

namespace App\Http\Controllers;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Case_;
use App\Users;
use App\User_Details;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use App\Case_Record_Type;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Cases_Types;
use App\Geo_Cities;
use App\Geo_Countries;
use App\Geo_Governorates;
use App\Courts;
use App\Case_Client;
use App\Case_Record;
use App\Case_Record_Document;
use App\Case_Lawyer;
use App\Case_Client_Role;
use App\Case_Document;
use App\Case_Techinical_Report;
use App\Tasks;
use App\Exports\CasesExport;


class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cases=Case_::with('case_types')->with('governorates')->with('cities')->with('courts')->get();
        // dd($cases);
        $roles=Case_Client_Role::all();
        $types = Cases_Types::all();
        $courts=Courts::all();
       foreach($roles as $role)
       {
        $role['name_ar']=Helper::localizations('case_client_roles','name',$role->id);

       }
       // dd($roles);
        return view('cases.cases')->with('cases',$cases)->with('roles',$roles)->with('types',$types)->with('courts',$courts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $clients=Users::whereHas('rules', function ($query) {
                                            $query->where('rule_id', '6');
                                        })->get();
         $cases_record_types=Case_Record_Type::all();
         // dd($cases_record_types);
        // dd($clients);
         foreach ($cases_record_types as  $value) {
            $value['name_ar']= Helper::localizations('case_report_types','name',$value->id);
         }
         $cases_types=Cases_Types::all();
         $courts=Courts::all();
         $governorates=Geo_Governorates::all();
         $countries=Geo_Countries::all();
         $cities=Geo_Cities::all();
         $lawyers=Users::whereHas('rules', function ($query) {
        $query->where('rule_id', '5');
        })->with(['user_detail'=>function($q) {
                 $q->orderby('join_date','desc');
                 }])->get();
        foreach($lawyers as $detail){
            
                if($detail->user_detail()->count() != 0)
                {
                    // dd($detail->user_detail);
                    $value=Helper::localizations('geo_countires','nationality',$detail->user_detail->nationality_id);
              
                $detail['nationality']=$value;
                }
                else
                {
                    $detail['nationality']='';
                 }
                }
        
          // dd($cases_record_types);
      $roles=Case_Client_Role::all();

       foreach($roles as $role)
       {
        $role['name_ar']=Helper::localizations('case_client_roles','name',$role->id);

       }
        return view('cases.case_add')->with('clients',$clients)->with('cases_record_types',$cases_record_types)->with('cases_types',$cases_types)->with(['courts'=>$courts,'governorates'=>$governorates,'countries'=>$countries,'cities'=>$cities,'lawyers'=>$lawyers,'roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cases_record_types=Case_Record_Type::all();
         // dd($cases_record_types);
        // dd($clients);
         foreach ($cases_record_types as  $value) {
            $value['name_ar']= Helper::localizations('case_report_types','name',$value->id);
         }
        $case=Case_::where('id',$id)->with(['tasks'=>function($query){
            $query->where('task_type_id',2)->orderBy('id','desc');
        }])->with(['case_records'=>function($q){
            $q->with('case_record_documents');
        }])->first();
               // dd($case);
        return view('cases.case_view')->with('case',$case)->with('cases_record_types',$cases_record_types);
    }

    public function archive_show($id)
    {
        $case=Case_::find($id);
        return view('cases.case_archive_view')->with('case',$case);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case=Case_::where('id',$id)->with(['case_records'=>function($q){
            $q->with('case_record_documents');
        }])->first();
        $clients=Users::whereHas('rules', function ($query) {
                                            $query->where('rule_id', '6');
                                        })->get();
         $cases_record_types=Case_Record_Type::all();
         // dd($cases_record_types);
        // dd($clients);
         foreach ($cases_record_types as  $value) {
            $value['name_ar']= Helper::localizations('case_report_types','name',$value->id);
         }
         $cases_types=Cases_Types::all();
         $courts=Courts::all();
         $governorates=Geo_Governorates::all();
         $countries=Geo_Countries::all();
         $cities=Geo_Cities::all();
         $lawyers=Users::whereHas('rules', function ($query) {
        $query->where('rule_id', '5');
        })->with(['user_detail'=>function($q) {
                 $q->orderby('join_date','desc');
                 }])->get();
        foreach($lawyers as $detail){
            
                if($detail->user_detail()->count() !=0)
                {
                    $value=Helper::localizations('geo_countires','nationality',$detail->user_detail->nationality_id);
              
                $detail['nationality']=$value;
                }
                else
                {
                    $detail['nationality']='';
                 }
                }
        
          // dd($cases_record_types);
      $roles=Case_Client_Role::all();

       foreach($roles as $role)
       {
        $role['name_ar']=Helper::localizations('case_client_roles','name',$role->id);

       }
        // dd($case->lawyers->toArray());
        return view('cases.case_edit')->with('case',$case)->with('clients',$clients)->with('cases_record_types',$cases_record_types)->with('cases_types',$cases_types)->with(['courts'=>$courts,'governorates'=>$governorates,'countries'=>$countries,'cities'=>$cities,'lawyers'=>$lawyers,'roles'=>$roles])->with('client_count',count($case->clients()));
    }



   public function edit_case(Request $request , $id)
   {
    // dd($request->all());
    $validator = Validator::make($request->all(), [
            'folder_num'=>'required',
            'case_dateRang'=>'required',
            'case_type'=>'required',
            'court_name'=>'required',
            'claim_num'=>'required',
            'case_year'=>'required',
            'case_date'=>'required',
            'case_fees'=>'required',

            'governorate'=>'required',
            'city'=>'required',
            'enemy_name'=>'required',
            'enemy_type'=>'required',
            'enemy_address'=>'required',
             'enemy_lawyer'=>'required',
            'subject'=>'required',
            'client_code'=>'required',
            'authorization_num'=>'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

      $case=Case_::find($id);
      $start_time=explode('-', $request['case_dateRang'])[0];
       $end_time=explode('-', $request['case_dateRang'])[1];
      $case->update([
            'office_file_number'=>$request['folder_num'],
            'case_type_id'=>$request['case_type'],
            'court_id'=>$request['court_name'],
            'claim_number'=>$request['claim_num'],
            'claim_year'=>$request['case_year'],
            'claim_date'=>date('Y-m-d h:i:s',strtotime($request['case_date'])),
            'claim_expenses'=>$request['case_fees'],
            'geo_governorate_id'=>$request['governorate'],
            'geo_city_id'=>$request['city'],
            'region'=>$request['circle'],
            'case_startdate'=>date('Y-m-d h:i:s',strtotime($start_time)),
            'case_enddate'=>date('Y-m-d h:i:s',strtotime($end_time)),
            'contender_name'=>$request['enemy_name'],
            'contender_case_client_role_id'=>$request['enemy_type'],
            'contender_address'=>$request['enemy_address'],
            'contender_laywer'=>$request['enemy_lawyer'],
            'case_body'=>$request['subject'],
            'case_notes'=>$request['notes'],
            'created_by'=>\Auth::user()->id,
        ]);
      $case->save();
      if($request->has('lawyer_id'))
      {
        Case_Lawyer::where('case_id',$id)->delete();
        foreach ($request['lawyer_id'] as $key => $value) {
            Case_Lawyer::create([
                'case_id'=>$id,
                'lawyer_id'=>$key,
            ]);
        }
      }
      Case_Client::where('case_id',$id)->delete();
      // dd($request->all());
      // dd($request['client_name'][1]);
      foreach($request['client_code'] as $key => $value) {
         Case_Client::Create([
                'case_id'=>$case->id,
                'client_id'=>$request['client_code'][$key],
                'case_client_role_id'=>$request['client_character'][$key],
                'attorney_number'=>$request['authorization_num'][$key],
            ]);
      }
      Helper::add_log(4,14,$id);
       return  redirect()->route('cases');
      // dd($request->all());
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
        
        Case_::destroy( $id);
        Case_Client::where('case_id',$id)->delete();
        Case_Document::where('case_id',$id)->delete();
        Case_Lawyer::where('case_id',$id)->delete();
        Case_Record::where('case_id',$id)->delete();
        Case_techinical_Report::where('case_id',$id)->delete();
        Helper::add_log(5,14,$id);
        return  redirect()->route('cases');
    }

     public function destroy_all()
    {
        
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            Case_::destroy($id);
           Case_Client::where('case_id',$id)->delete();
        Case_Document::where('case_id',$id)->delete();
        Case_Lawyer::where('case_id',$id)->delete();
        Case_Record::where('case_id',$id)->delete();
        Case_techinical_Report::where('case_id',$id)->delete();
        Helper::add_log(5,14,$id);
        } 
        return  redirect()->route('cases');
    }


    public function add(Request $request)
    {
        // dd($request->all());
         $validator = Validator::make($request->all(), [
            'folder_num'=>'required',
            'case_dateRang'=>'required',
            'case_type'=>'required',
            'court_name'=>'required',
            'claim_num'=>'required',
            'case_year'=>'required',
            'case_date'=>'required',
            'case_fees'=>'required',

            'governorate'=>'required',
            'city'=>'required',
            'enemy_name'=>'required',
            'enemy_type'=>'required',
            'enemy_address'=>'required',
             'enemy_lawyer'=>'required',
            'subject'=>'required',
            'client_code'=>'required',
            'authorization_num'=>'required',
            'investigation_no'=>'required',
            'investigation_type'=>'required',
            'investigation_date'=>'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }


       $start_time=explode('-', $request['case_dateRang'])[0];
       $end_time=explode('-', $request['case_dateRang'])[1];
        $case=Case_::Create([
            'office_file_number'=>$request['folder_num'],
            'case_type_id'=>$request['case_type'],
            'court_id'=>$request['court_name'],
            'claim_number'=>$request['claim_num'],
            'claim_year'=>$request['case_year'],
            'claim_date'=>date('Y-m-d h:i:s',strtotime($request['case_date'])),
            'claim_expenses'=>$request['case_fees'],
            'geo_governorate_id'=>$request['governorate'],
            'geo_city_id'=>$request['city'],
            'region'=>$request['circle'],
            'case_startdate'=>date('Y-m-d h:i:s',strtotime($start_time)),
            'case_enddate'=>date('Y-m-d h:i:s',strtotime($end_time)),
            'contender_name'=>$request['enemy_name'],
            'contender_case_client_role_id'=>$request['enemy_type'],
            'contender_address'=>$request['enemy_address'],
            'contender_laywer'=>$request['enemy_lawyer'],
            'case_body'=>$request['subject'],
            'case_notes'=>$request['notes'],
            'created_by'=>\Auth::user()->id,
        ]);
        for($i=0;$i<count($request['client_code']);$i++)
        {
            Case_Client::Create([
                'case_id'=>$case->id,
                'client_id'=>$request['client_code'][$i],
                'case_client_role_id'=>$request['client_character'][$i],
                'attorney_number'=>$request['authorization_num'][$i],
            ]);
        }
        $case_record=Case_Record::Create([
            'case_id'=>$case->id,
            'record_number'=>$request['investigation_no'],
            'record_type_id'=>$request['investigation_type'],
            'record_date'=>date('Y-m-d h:i:s',strtotime($request['investigation_date'])),
            'created_by'=>\Auth::user()->id,
        ]);
if($request->hasFile('docs_upload')){
    
        foreach ($request->docs_upload as  $key => $file) {
            
            $destinationPath='investigation_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('docs_upload')[$key]->move($destinationPath,$fileNameToStore);

            Case_Record_Document::Create([
                'record_id'=>$case_record->id,
                'name'=>time().rand(111,999).'.'.$file->getClientOriginalExtension(),
                'file'=>$fileNameToStore,
                ]);
        }
        }
        //  if($request->hasFile('chooseFile_case')){
        // foreach ($request->docs_upload as  $key => $file) {
            
        //     $destinationPath='cases_images';
        //     $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
        //     // dd($fileNameToStore);
        //     Input::file('chooseFile_case')[$key]->move($destinationPath,$fileNameToStore);
        // }
        // }
       if($request->has('lawyer_id'))
       {
        foreach ($request['lawyer_id'] as $key => $value) {
            Case_Lawyer::Create([
                'case_id'=>$case->id,
                'lawyer_id'=>$key,
            ]);
        }
       }
         // dd($request->all());
        // return $this->create();
        Helper::add_log(3,14,$case->id);
       return redirect()->route('cases')->with('success','تم إضافه قضيه جديده بنجاح');
    }
    function lawyers_filter(Request $request)
    {
        // $request = (array)json_decode($request->getContent(), true);
        $lawyers=Users::whereHas('rules', function ($query) {

        $query->where('rule_id', '5');
        })->where(function($query)use($request){

            if($request->has('lawyer_code') && $request['lawyer_code'] != '')
            {

               $query->where('code',$request->lawyer_code);  
            }
            if($request->has('lawyer_name')&& $request['lawyer_name'] != '')
            {

               $query->where('name',$request->lawyer_name);  
            }
            if($request->has('lawyer_tel')&& $request['lawyer_tel'] != '')
            {

               $query->where('mobile',$request->lawyer_tel);  
            }

        })->with(['user_detail'=>function($query) use ($request){
                
                if($request->has('lawyer_level')&& $request['lawyer_level'] != '')
                        {

                           $query->where('litigation_level',$request->lawyer_level);  
                        }
                        if($request->has('lawyer_national_id')&& $request['lawyer_national_id'] != '')
                        {

                           $query->where('national_id',$request->lawyer_national_id);  
                        }
                         if($request->has('start_date')&& $request['start_date'] != '')
                        {

                           $query->where('join_date',date('Y-m-d H:i:s',strtotime($request->start_date)));  
                        }
                         if($request->has('lawyer_work_sector')&& $request['lawyer_work_sector'] != '')
                        {

                           $query->where('work_sector',$request->lawyer_work_sector);  
                        }

              
                $query->orderby('join_date','desc');
                 }])->get();
          // dd($lawyers);
        foreach($lawyers as $detail){
            if(count(Consultation_Lawyers::where('lawyer_id',$detail->id)->where('consultation_id',$id)->first()))
                {
                    
                    $detail['assigned']=1;
                }
                else
                {
                    $detail['assigned']=0;
                }
                if(count($detail->user_detail)!=0)
                {
                    // dd($detail->user_detail->nationality_id);
                   $value=Helper::localizations('geo_countires','nationality',$detail->user_detail->nationality_id);
              // dd($value);
                $detail['nationality']=$value; 
                }
                else
                {
                   $detail['nationality']='';  
                }
                
                 }
                
        return $this->filter_create($lawyers);
        // return response()->json('success');
    }
    public function filter_create($lawyers)
    {
         $clients=Users::whereHas('rules', function ($query) {
                                            $query->where('rule_id', '6');
                                        })->get();
         $cases_record_types=Case_Record_Type::all();
         // dd($cases_record_types);
        // dd($clients);
         foreach ($cases_record_types as  $value) {
            $value['name_ar']= Helper::localizations('case_report_types','name',$value->id);
         }
         $cases_types=Cases_Types::all();
         $courts=Courts::all();
         $governorates=Geo_Governorates::all();
         $countries=Geo_Countries::all();
         $cities=Geo_Cities::all();
         
        
          // dd($cases_record_types);
         $roles=Case_Client_Role::all();

       foreach($roles as $role)
       {
        $role['name_ar']=Helper::localizations('case_client_roles','name',$role->id);

       }
        return view('cases.case_add')->with('clients',$clients)->with('cases_record_types',$cases_record_types)->with('cases_types',$cases_types)->with(['courts'=>$courts,'governorates'=>$governorates,'countries'=>$countries,'cities'=>$cities,'lawyers'=>$lawyers,'roles'=>$roles]);
    }
    public function change_case_state($id)
    {

        $state = $_POST['case_state'];
        $case=Case_::find($id);
        $case->update(['archived'=>$state]);
        // dd($case);
        return redirect()->route('case_view',$id);
        
    }


    //////add sessions
    public function add_session(Request $request , $id)
    {
        // dd($request->all());
        $task=Tasks::where('case_id',$id)->orderBy('id', 'desc')->first();
        if(count($task)!=0)
        {
            Tasks::create([
            'case_id'=>$id,
            'level'=>$request['degree'],
            'roll'=>$request['roll'],
            'expenses'=>$request['expenses'],
            'start_datetime'=>$task->next_datetime,
            'next_datetime'=>date('Y-m-d h:s:i',strtotime($request['end_datetime'])),
            'name'=>$request['name'],
            'description'=>$request['description'],
            'task_type_id'=>2,
        ]);
        }
        else
        {
          Tasks::create([
            'case_id'=>$id,
            'level'=>$request['degree'],
            'roll'=>$request['roll'],
            'expenses'=>$request['expenses'],
            'start_datetime'=>date('Y-m-d h:s:i',strtotime($request['start_datetime'])),
            'next_datetime'=>date('Y-m-d h:s:i',strtotime($request['end_datetime'])),
            'name'=>$request['name'],
            'description'=>$request['description'],
            'task_type_id'=>2,
        ]);  
        }
        
        // dd(Case_::find($id));
        return redirect()->route('case_view',$id);
    }


    //add record
    public function add_record(Request $request , $id)
    {
// dd($request->all());
$case_record=Case_Record::Create([
            'case_id'=>$id,
            'record_number'=>$request['investigation_no'],
            'record_type_id'=>$request['investigation_type'],
            'record_date'=>date('y-m-d h:i:s',strtotime($request['record_date'])),
            'created_by'=>\Auth::user()->id,
        ]);
if($request->has('record_documents')){
    // dd($request['record_documents']);
        foreach ($request->record_documents as  $key => $file) {
            
            $destinationPath='investigation_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('record_documents')[$key]->move($destinationPath,$fileNameToStore);

            Case_Record_Document::Create([
                'record_id'=>$case_record->id,
                'name'=>$file->getClientOriginalName(),
                'file'=>$fileNameToStore,
                ]);
        }
        }
           return redirect()->route('case_view',$id);
    }
    public function add_record_ajax(Request $request , $id )
    {

          // return response()->json($_GET['files']);
// return response()->json($_GET['files']);

// $case_record=Case_Record::Create([
//             'case_id'=>$id,
//             'record_number'=>$request['investigation_no'],
//             'record_type_id'=>$request['investigation_type'],
//             'record_date'=>date('y-m-d h:i:s',strtotime($request['investigation_date'])),
//             'created_by'=>\Auth::user()->id,
//         ]);
// if(isset($_GET['files'])){
//     // dd($request['record_documents']);
   
//     // return response()->json(file_put_contents('sara',serialize($request['files'])));
//      $error = false;
//     $files = array();

//     $uploaddir = public_bath().'/case_documents/';
//         foreach($_GET['files']  as $file) {
//              return response()->json($file);
//             if(move_uploaded_file($file, $uploaddir .basename($file)))
//                 {
//                     $files[] = $uploaddir .$file;
//                 }
//                 else
//                 {
//                     $error = true;
//                 }
//               // return response()->json($file['tmp_name']);
//             // $destinationPath='investigation_images';
//             // $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
//             // // dd($fileNameToStore);
//             // Input::file('files')[$key]->move($destinationPath,$fileNameToStore);

//             // Case_Record_Document::Create([
//             //     'record_id'=>$case_record->id,
//             //     'name'=>$file->getClientOriginalName(),
//             //     'file'=>$fileNameToStore,
//             //     ]);
//         }
//         }
        $case_record=Case_Record::Create([
            'case_id'=>$id,
            'record_number'=>$request['investigation_no'],
            'record_type_id'=>$request['investigation_type'],
            'record_date'=>date('y-m-d h:i:s',strtotime($request['record_date'])),
            'created_by'=>\Auth::user()->id,
        ]);
if($request->has('record_documents')){
    // dd($request['record_documents']);
        foreach ($request->record_documents as  $key => $file) {
            
            $destinationPath='investigation_images';
            $fileNameToStore=$destinationPath.'/'.time().rand(111,999).'.'.$file->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('record_documents')[$key]->move($destinationPath,$fileNameToStore);

            Case_Record_Document::Create([
                'record_id'=>$case_record->id,
                'name'=>$file->getClientOriginalName(),
                'file'=>$fileNameToStore,
                ]);
        }
        }
           return redirect()->route('case_edit',$id);
    }

    ///destroy case record 
    public function destroy_record($id,$record_id)
    {
        Case_Record::destroy( $record_id);
        Case_Record_Document::where('record_id',$record_id)->delete();

        return redirect()->route('case_view',$id);
    }

    public function download_document($id)
    {
        $document=Case_Record_Document::find($id);
        $file= public_path()."/". $document->file;
        // $split =explode('.',$document->file);
        // $ext = end($split);

    // $headers = array(
    //           'Content-Type: application/text',
    //         );

    return response()->download($file, $document->name);
    }

    public function download_all_documents($id)
    {
        // \File::delete(public_path().'/investigations.zip');
        $zipper = new \Chumper\Zipper\Zipper;

        $docuemnts=Case_Record::where('id',$id)->with('case_record_documents')->first();
        if(count($docuemnts->case_record_documents) > 0 )
        {
           foreach ($docuemnts->case_record_documents as  $document) {
            $file=  $document->file;
           $zipper->zip('investigations.zip')->add($file);
           
        }
        $zipper->close();
        return response()->download(public_path()."/investigations.zip")->deleteFileAfterSend(true); 
        }
        return redirect()->back();
         // return response()->download(public_path()."/investigations.zip");
    }

    public function filter_cases(Request $request)
    {
        // dd($request->all());
        $cases=Case_::where(function($q) use($request){

             if($request->filled('case_type'))
              {
               $q->where('case_type_id',$request->case_type);  
             }
             if($request->filled('court_name'))
              {
               $q->where('court_id',$request->court_name);  
             }
             if($request->filled('circle'))
              {
               $q->where('region',$request->circle);  
             }
              if($request->filled('year_from') && $request->filled('year_to'))
              {
               $q->where('claim_year','<=',$request->year_from)->where('claim_year','<=',$request->year_to);  
             }
             if($request->filled('case_date_from') && $request->filled('case_date_to'))
              {
               $q->where('claim_date','<=',$request->case_date_from)->where('claim_date','<=',$request->case_date_to);  
             }
        })->get();

         $roles=Case_Client_Role::all();
        $types = Cases_Types::all();
        $courts=Courts::all();
       foreach($roles as $role)
       {
        $role['name_ar']=Helper::localizations('case_client_roles','name',$role->id);

       }
        return view('cases.cases')->with('cases',$cases)->with('roles',$roles)->with('types',$types)->with('courts',$courts);
       // return redirect()->back();
    }
     public function excel()
    {   
      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'cases'.time().'.xlsx';
      if(isset($_GET['ids'])){
       $ids = $_GET['ids'];
       
       Excel::store(new CasesExport($ids),$filepath.$filename);
       return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      $type=$_GET['type'];
      Excel::store((new CasesExport($filters,$type)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
    else{
        $type=$_GET['type'];
      Excel::store((new CasesExport(null,$type)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
  }
}
