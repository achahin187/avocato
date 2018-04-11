<?php

namespace App\Http\Controllers;

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

       foreach($roles as $role)
       {
        $role['name_ar']=Helper::localizations('case_client_roles','name',$role->id);

       }
       // dd($roles);
        return view('cases.cases')->with('cases',$cases)->with('roles',$roles);
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
            
                if(count($detail->user_detail)!=0)
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
        $case=Case_::where('id',$id)->with('case_clients')->with('case_documents')->with('case_records')->with('case_techinical_reports')->with('lawyers')->with(['tasks'=>function($query){
            $query->where('task_type_id',2)->orderBy('id','desc');
        }])->with('clients')->with(['case_records'=>function($q){
            $q->with('case_record_documents');
        }])->first();
              // dd($case);
        return view('cases.case_view')->with('case',$case)->with('cases_record_types',$cases_record_types);
    }

    public function archive_show()
    {
        return view('cases.case_archive_view');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cases.case_edit');
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
        } 
        return  redirect()->route('cases');
    }


    public function add(Request $request)
    {
        // dd($request->all());
        
       $start_time=explode('-', $request['case_dateRang'])[0];
       $end_time=explode('-', $request['case_dateRang'])[1];
        $case=Case_::Create([
            'office_file_number'=>$request['folder_num'],
            'case_type_id'=>$request['case_type'],
            'court_id'=>$request['court_name'],
            'claim_number'=>$request['claim_num'],
            'claim_year'=>$request['case_year'],
            'claim_date'=>date('y-m-d h:i:s',strtotime($request['case_date'])),
            'claim_expenses'=>$request['case_fees'],
            'geo_governorate_id'=>$request['governorate'],
            'geo_city_id'=>$request['city'],
            'region'=>$request['circle'],
            'case_startdate'=>date('y-m-d h:i:s',strtotime($start_time)),
            'case_enddate'=>date('y-m-d h:i:s',strtotime($end_time)),
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
            'record_date'=>date('y-m-d h:i:s',strtotime($request['investigation_date'])),
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
        return $this->create();
    }
    function lawyers_filter(Request $request)
    {
        
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
            'next_datetime'=>date('y-m-d h:s:i',strtotime($request['end_datetime'])),
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
            'start_datetime'=>date('y-m-d h:s:i',strtotime($request['start_datetime'])),
            'next_datetime'=>date('y-m-d h:s:i',strtotime($request['end_datetime'])),
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

    ///destroy case record 
    public function destroy_record($case_id,$id)
    {
        Case_Record::destroy( $id);
        Case_Record_Document::where('record_id',$id)->delete();

        return redirect()->route('case_view',$case_id);
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
        \File::delete(public_path().'/investigations.zip');
        $zipper = new \Chumper\Zipper\Zipper;

        $docuemnts=Case_Record::where('id',$id)->with('case_record_documents')->first();
        foreach ($docuemnts->case_record_documents as  $document) {
            $file=  $document->file;
           $zipper->zip('investigations.zip')->add($file);
           
        }
        $zipper->close();
         return response()->download(public_path()."/investigations.zip");
    }
}
