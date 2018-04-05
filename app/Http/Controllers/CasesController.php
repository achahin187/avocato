<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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


class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('cases.cases');
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
            
                if(count($detail->user_detail)>1)
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
        return view('cases.case_add')->with('clients',$clients)->with('cases_record_types',$cases_record_types)->with('cases_types',$cases_types)->with(['courts'=>$courts,'governorates'=>$governorates,'countries'=>$countries,'cities'=>$cities,'lawyers'=>$lawyers]);
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
    public function show()
    {
        return view('cases.case_view');
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
    public function edit()
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
        //
    }


    public function add(Request $request)
    {
        
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
                'name'=>'',
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
    function lawyers_filter(Request $request,$id)
    {
        $consultation = Consultation::find($id);
        $lawyers=Users::whereHas('rules', function ($query) {

        $query->where('rule_id', '5');
        })->where(function($query)use($request){

            if($request->filled('lawyer_code'))
            {

               $query->where('code',$request->lawyer_code);  
            }
            if($request->filled('lawyer_name'))
            {

               $query->where('name',$request->lawyer_name);  
            }
            if($request->filled('lawyer_tel'))
            {

               $query->where('mobile',$request->lawyer_tel);  
            }

        })->with(['user_detail'=>function($query) use ($request){
                
                        if($request->filled('lawyer_level'))
                        {

                           $query->where('litigation_level',$request->lawyer_level);  
                        }
                        if($request->filled('lawyer_national_id'))
                        {

                           $query->where('national_id',$request->lawyer_national_id);  
                        }
                         if($request->filled('start_date'))
                        {

                           $query->where('join_date',date('Y-m-d H:i:s',strtotime($request->start_date)));  
                        }
                         if($request->filled('lawyer_work_sector'))
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
        
       return $this->create();
    }
}
