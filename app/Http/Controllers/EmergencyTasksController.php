<?php

namespace App\Http\Controllers;
use Excel;
use Illuminate\Http\Request;
use App\Tasks;
use App\Task_Status_History;
use Carbon\Carbon;
use App\Users;
use App\Exports\EmergencyTasksExport;
use Jenssegers\Date\Date;
use App\Notifications;
use App\Notification_Types;
use App\Notification_Items;
use App\Notifications_Push;
use Session;
use App\Entity_Localizations;
use App\Task_Charges;
use App\Case_Techinical_Report;
use function GuzzleHttp\json_encode;

use App\Case_Techinical_Report_Document;
use App\Helpers\Base64ToImageService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
class EmergencyTasksController extends Controller
{
    public function view($id)
    {
      
      $data['task']=Tasks::where('id',$id)->with('client')->where('country_id',session('country'))->first();
      if( $data['task'] == NULL ) {
        Session::flash('warning', 'لم يتم العثور على الحاله الطارئه');
        return redirect('/tasks_emergency');
      }
      $data['charges'] = Task_Charges::where('task_id', $id)->get();
      $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();
      $data['statuses'] = Entity_Localizations::where('entity_id', 4)->where('field', 'name')->get();
      $data['reports'] = Case_Techinical_Report::where('item_id', $data['task']->id)->where('technical_report_type_id', 1)->get();
//  dd($data['reports']);
    	return view('tasks.emergency_view',$data);
    }

    public function change_task_state(Request $request  ,$id)
    {
    	$state = $request['task_satuts'];
        $task=Tasks::find($id);
        $task->update(['task_status_id'=>$state]);
        // dd($case);
        Task_Status_History::create([
        	'task_id'=>$task->id,
        	'task_status_id'=>$state,
        	'datetime'=>Carbon::now()->format('Y-m-d H:i:s'),
        	'user_id'=>\Auth::user()->id
        ]);

        return redirect()->route('task_emergency_view',$id);
    }
    public function task_destroy($id)
    {
   $task=Tasks::find($id)->delete();
   
   return redirect()->route('tasks_emergency');
    }

    public function task_destroy_all()
    {
    	$ids = $_POST['ids'];
        foreach($ids as $id)
        {
        $task=Tasks::find($id)->delete();
        } 
        return redirect()->route('tasks_emergency');
    }

    public function add_emergency_task(Request $request)
    {
                    $input=[];
                     $input['client_id']=$request['client_id'];
                     $input['task_type_id']=1;
                     $input['task_status_id']=1;
                     $input['client_longitude']=$request['client_long'];
                     $input['client_latitude']=$request['client_lat'];
                     $input['description']=$request['description'];
                     $input['created_by']=\Auth::user()->id;
                     $input['start_datetime']=Carbon::now()->format('Y-m-d H:i:s');
                     $input['created_at']=Carbon::now()->format('Y-m-d H:i:s');
                     $input['country_id']=session('country');
                     
                     $task = Tasks::create($input);
                 
                     $input2=[];
                     $input2['task_id']=$task->id;
                     $input2['task_status_id']=$task->task_status_id;
                     $input2['user_id']=\Auth::user()->id;
                     $input2['datetime']=Carbon::now()->format('Y-m-d H:i:s');
                     
                     $task_status_history=Task_Status_History::create($input2);
                     
                     Helper::add_log(7,15,$task->id);
                     session()->flash('success', 'Task Added Successfully');                    
                 return redirect()->route('tasks_emergency');
    }

    public function assign_emergency_task($id)
    {
    	$data['task']=Tasks::where('id',$id)->first();
      $data['lawyers']=Users::Distance($data['task']->client_latitude,$data['task']->client_longitude,50,"km")
                              ->IsActive()
                              ->whereHas('rules', function ($query) {
                                    $query->where('rule_id', '5');
                                    })->whereHas('user_detail',function($q){
                                    $q->where('receive_emergency',1);
                                    $q->with('nationality');
                                  }) 
                              ->get();
        // dd($data['lawyers']);
        // foreach($data['lawyers'] as $detail){
            
        //         if(count($detail->user_detail)>1)
        //         {
        //             $value=Helper::localizations('geo_countires','nationality',$detail->user_detail->nationality_id);
              
        //         $detail['nationality']=$value;
        //         }
        //         else
        //         {
        //             $detail['nationality']='';
        //          }
        //         }
    	return view('tasks.assign_emergency_task',$data);
    }

    public function assign_lawyer_emergency_task(Request $request , $id)
    {
    	// dd($request->all());
      

      $task = Tasks::find($id);
      $client=Users::find($task->client_id);
    	$task->update([
    		'assigned_lawyer_id'=>$request['lawyer_id'],
        'who_assigned_lawyer_id'=>\Auth::user()->id,
        'task_assignment_date'=>carbon::now()
    	]);
      $user=Users::find($request['lawyer_id']);
      $notification_type=Notification_Types::find(11);
      // $notification=Notifications::create([
      //           "msg"=>$notification_type->msg,
      //           "entity_id"=>11,
      //           "item_id"=>$id,
      //           "item_name"=>($client)?$client->name:"",
      //           "user_id"=>$request['lawyer_id'],
      //           "notification_type_id"=>11,
      //           "is_read"=>0,
      //           "is_sent"=>0,
      //           'is_push'=>$notification_type->is_push,
      //           "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
      //       ]);
      $notification=Notifications::create([
                "msg"=>$notification_type->msg,
                "entity_id"=>11,
                "item_id"=>($client)?$client->id:"0",
                "item_name"=>($client)?$client->name:"",
                "user_id"=>$request['lawyer_id'],
                "notification_type_id"=>11,
                "is_read"=>0,
                "is_sent"=>0,
                'is_push'=>$notification_type->is_push,
                "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
            ]);
             $notification_push=Notifications_Push::create([
                "notification_id"=>$notification->id,
                "device_token"=>$user->device_token ,
                "mobile_os"=>$user->mobile_os,
                "lang_id"=>$user->lang_id,
                "user_id"=>$request['lawyer_id']
            ]);
              
      $notification_type_client=Notification_Types::find(13);
      $notification_client=Notifications::create([
                "msg"=>$notification_type_client->msg,
                "entity_id"=>12,
                "item_id"=>$request['lawyer_id'],
                "item_name"=>$user->full_name,
                "user_id"=>$task->client_id,
                "notification_type_id"=>13,
                "is_read"=>0,
                "is_sent"=>0,
                'is_push'=>$notification_type_client->is_push,
                "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
            ]);
             $notification_push=Notifications_Push::create([
                "notification_id"=>$notification_client->id,
                "device_token"=>$client->device_token ,
                "mobile_os"=>$client->mobile_os,
                "lang_id"=>$client->lang_id,
                "user_id"=>$task->client_id
            ]);
    	return redirect()->route('tasks_emergency')->with('success','تم تعيين محامى للمهمه بنجاح');
    }
       public function lawyer_task($id , $task_id)
    { 
      $data['task']=Tasks::find($task_id);
      Date::setLocale('ar');
      $tasks = Tasks::where('assigned_lawyer_id',$id)->get();
      foreach($tasks as $task){
      $tasks_months[Date::parse($task->start_datetime)->format('F')][] = [
                              'id'=>$task->id,
                              'name'=>$task->name,
                              'start_datetime'=>$task->start_datetime,
                              'end_datetime'=>$task->end_datetime,
                              'task_type_id'=>$task->task_type_id,
                                    ];
      }
      $data['tasks_months'] = $tasks_months;
      $div = view('tasks.task_emergency_assign_lawyer',$data)->render();
      return response()->json($div);
    }


    public function emergency_lawyer_assign_filter(Request $request ,$id)
    {
      // dd($request->all());
      $data['task']=Tasks::where('id',$id)->first();
      $data['lawyers'] = Users::where('country_id',session('country'))->where(function($q) use($request){

         if($request->filled('work_sector'))
              {
               $q->whereHas('user_detail',function($q) use($request){
                $q->where('work_sector','like','%'.$request->work_sector.'%');

              });  
             }
             if($request->filled('lawyer_degree'))
              {
               $q->whereHas('user_detail',function($q) use($request){
                $q->where('litigation_level','like','%'.$request->lawyer_degree.'%');

              });  
             }
             if($request->filled('start_date_from') && $request->filled('start_date_to'))
              {
               $q->whereHas('user_detail',function($q) use($request){
                $q->where('join_date','>=',date('Y-m-d H:i:s',strtotime($request->start_date_from)))->where('join_date','<=',date('Y-m-d H:i:s',strtotime($request->start_date_to)));

              });  
             }
             if($request->filled('work_type'))
              {
               $q->whereHas('user_detail',function($q) use($request){
                $q->where('work_sector_type','like','%'.$request->work_type.'%');

              });  
             }
      })->get();
      // dd($data);
      return view('tasks.assign_emergency_task',$data);
      // dd($data['lawyers']);
    }

    public function excel()
    {   
      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'emergency_tasks'.time().'.xlsx';
      if(isset($_GET['ids'])){
       $ids = $_GET['ids'];
       
       Excel::store(new EmergencyTasksExport($ids),$filepath.$filename);
       return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      
      Excel::store((new EmergencyTasksExport($filters)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
    else{
        
      Excel::store((new EmergencyTasksExport()),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
  }

  public function emergency_task_filter(Request $request)
  {
    // dd($request->all());
    $data['tasks']=Tasks::where('country_id',session('country'))->where(function($q) use($request){

     $q->where('task_type_id',1);
              if($request->filled('date_from') && $request->filled('date_to'))
              {
                $date_from=date('Y-m-d h:i:s',strtotime($request->date_from));
             $date_to=date('Y-m-d h:i:s',strtotime($request->date_to));
                 $q->where('start_datetime','>=',$date_from)->where('start_datetime','<=',$date_to);
              }
              elseif($request->filled('date_from') && !$request->filled('date_to'))
              {
                $date_from=date('Y-m-d h:i:s ',strtotime($request->date_from));
                $q->where('start_datetime','>=',$date_from);
              }
              elseif($request->filled('date_to') && !$request->filled('date_from'))
              {
                $date_from=date('Y-m-d h:i:s ',strtotime($request->date_to));
                $q->where('start_datetime','<=',$date_to);
              }
             //  if($request->filled('time_from') && $request->filled('time_to'))
             //  {
             //    $time_from=date('h:i A',strtotime($request->time_from));
             // $time_to=date('h:i A',strtotime($request->time_to));
             //     $q->where('start_datetime','>=',$time_from)->where('start_datetime','<=',$time_to);
             //  }
             //  elseif($request->filled('time_from') && !$request->filled('time_to'))
             //  {
             //    $time_from=date('h:i A',strtotime($request->time_from));
             //    $q->where('start_datetime','>=',$time_from);
             //  }
             //  elseif($request->filled('time_to') && !$request->filled('time_from'))
             //  {
             //    $time_to=date('h:i A',strtotime($request->time_to));
             //    $q->where('start_datetime','<=',$time_to);
             //  }
              if($request->filled('emergency_case'))
              {
                    if($request->emergency_case == 1 || $request->emergency_case == 2)
                    
                    {
                        $q->where('task_status_id',$request->emergency_case);
                    }
                    else
                    {

                        $q->whereIn('task_status_id',[1,2]);
                        // dd($q);
                    }
              }
              else
              {

                  $q->whereIn('task_status_id',[1,2]);
                  // dd($q);
              }
              if($request->filled('assign_lawyer'))
              {
                 if($request->assign_lawyer == 1 )
                    
                    {
                        $q->where('assigned_lawyer_id','!=',null);
                    }
                    elseif($request->assign_lawyer == 0 )
                    {

                        $q->where('assigned_lawyer_id','=',null);
                        // dd($q);
                    }
              }

    });

    if($request->filled('search'))
    {
      $data['tasks'] = $data['tasks']->distinct()->where(function($query) use ($request){
            
            $query->whereHas('client',function($q) use ($request){
                
                    $q->where('full_name','like', '%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%')->orwhere('cellphone','like','%'.$request->search.'%');
               
            });
      
    });
    }

    $data['tasks'] =$data['tasks']->paginate(10);


    $data['clients']=Users::where('country_id',session('country'))->whereHas('rules', function ($query) {
                                            $query->where('rule_id', '6');
                                        })->with('rules')->get();


        foreach ($data['clients'] as $key => $value) {
            foreach ($value['rules'] as $key1 => $value1) {
               if($value1['id'] != 6)
               {
                // dd($value1);
                $data['client_type'][$value['id']]=$value1['name_ar'];

               }
            }
        }
        return view('tasks.tasks_emergency',$data);
  }

  public function addEmergencyTaskDocument(Request $request){
              
      $validator = Validator::make($request->all(), [
         'task_id' => 'required',
         'file'  => 'required|max:3000',
         'description' => 'required',

    ]);

    if ($validator->fails()) {
      return redirect()->back()
          ->withErrors($validator)
          ->withInput();
  }else{
      
       
       $file = $request->file('file');
       $file_name = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
       $file->move(public_path('case_files'),$file_name);
       
      //Add files in table related to emergency tasks 
     

      $response = json_encode(['status' => 1]);
       
     return $response;
  }

 }

  public function add_task_report(Request $request , $id)
  {
    // dd($request->all());
    $validator = Validator::make(
      $request->all(),
      [
        'body' => 'required',
        // 'task_id'=>'required',
        'status' => 'required',
        'file' => 'required'
      ]
    );

    if ($validator->fails()) {
      // var_dump(current((array)$validator->errors()));
      return redirect()->back()
      ->withErrors($validator)
      ->withInput();
    }
    
        $task = Tasks::find($id);
        $case_report = Case_Techinical_Report::create([
          'technical_report_type_id' => $task->task_type_id,
          'case_id' => $task->case_id,
          'item_id' => $id,
          'body' => $request['body'],
          'created_by' => \Auth::user()->id,
        ]);
        
        if ($request->hasFile('file')) {

          foreach ($request->file as $key => $file) {

              $destinationPath = 'reports';
              $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $file->getClientOriginalExtension();
   
              Input::file('file')[$key]->move($destinationPath, $fileNameToStore);

             
              Case_Techinical_Report_Document::create([
                'case_techinical_report_id' => $case_report->id,
                'file' => $fileNameToStore,
              ]);
          }
      }
        // for ($i = 0; $i < count($request['file']); $i++) {
        //   if (strpos($request['file'][$i], 'base64') !== false) {
        //     $file = Base64ToImageService::convert($request['file'][$i], 'reports/');
        //   } else {
        //     $file = $request['file'][$i];
        //   }
        //   Case_Techinical_Report_Document::create([
        //     'case_techinical_report_id' => $case_report->id,
        //     'file' => $file,
        //   ]);
        // }


        $task->update(['task_status_id' => $request['status'], 'end_datetime' => Carbon::now()->format('Y-m-d H:i:s')]);
        task_status_history::create([
          'task_id' => $task->id,
          'task_status_id' => $request['status'],
          'datetime' => Carbon::now(),
          'user_id' => \Auth::user()->id
        ]);
        $task->update([
          'task_status_id' => $request['status']
        ]);

        // Notification::create([
        //   'msg' => 'قام المحامى ' . $user->name . ' باضافة تقرير فني',
        //   'entity_id' => 11,
        //   'item_id' => $task->id,
        //   'item_name' => $user->name,
        //   'notification_type_id' => 5,
        //   'is_read' => 0,
        //   'is_sent' => 0,
        //   'is_push' => 0,
        //   'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //   'user_id' => $user->id,
        //   'country_id' => $user->country_id
        // ]);
        return redirect()->back()->with('success','report uploaded successfully');
     
  }

}
