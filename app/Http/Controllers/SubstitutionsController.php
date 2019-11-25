<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Substitution;
use App\SubstitutionType;
use App\Task_Payment_Statuses;
use App\Entity_Localizations;
use App\Task_Charges;
use App\Case_Techinical_Report_Document;
use App\Case_Techinical_Report;
use App\Users;
use Carbon\carbon;
use Excel;
use App\Notification_Types;
use App\Notifications;
use App\Notifications_Push;
use App\Exports\SubstitutionsExport;
class SubstitutionsController extends Controller
{
    public function index()
    {
      // dd(carbon::now()->format('Y-m-d H:i:s'));
        $data['substitution_types']=SubstitutionType::all();
        $data['substitutions']=Tasks::where('task_type_id',4)->with(['substitution'=>function($q){
            $q->with('type');
        }])->with('lawyer')->with('lawyer_substitution')->get();

        return view('substitutions.index',$data);
    }

    public function assign($id)
    {
    	$data['task']=Tasks::where('id',$id)->first();
    	$data['lawyers']=Users::whereHas('rules', function ($query) {
        $query->where('rule_id', '5');
        })->where('is_active',1)->with(['user_detail'=>function($q) {
                
                 $q->orderby('join_date','desc');
                 }])->whereHas('user_detail',function($q){
                  $q->where('receive_emergency',1);
                 })->Distance($data['task']->client_longitude,$data['task']->client_latitude,500,"km")->get();
        // dd($data['lawyers']);
        foreach($data['lawyers'] as $detail){
            
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
    	return view('substitutions.assign',$data);
    }

    public function assign_lawyer(Request $request , $id)
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
      $notification=Notifications::create([
                "msg"=>$notification_type->msg,
                "entity_id"=>11,
                "item_id"=>$id,
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
    	return redirect()->route('substitutions')->with('success','تم تعيين محامى للانابه بنجاح');
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
      $div = view('substitutions.assign_lawyer',$data)->render();
      return response()->json($div);
    }


    public function assign_filter(Request $request ,$id)
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
      return view('substitutions.assign',$data);
      // dd($data['lawyers']);
    }

    public function show($id)
    {
      $data['substitution'] = Tasks::where('id',$id)->with(['substitution'=>function($q){
        $q->with('type');
    }])->with('lawyer')->with('lawyer_substitution')->first();


    if( $data['substitution'] == NULL ) {
      Session::flash('warning', 'لم يتم العثور على طلب الانابه');
      return redirect('/substitutions');
  }
  // dd($data);

  $data['charges'] = Task_Charges::where('task_id', $id)->get();
  $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();
  $data['statuses'] = Entity_Localizations::where('entity_id', 4)->where('field', 'name')->get();
  $data['reports'] = Case_Techinical_Report::where('item_id', $id)->where('technical_report_type_id', 4)->get();
    return view('substitutions.view',$data);
    }

    public function delete($id)
    {
      try{
        Substitution::where('task_id',$id)->delete();
        $task=Tasks::where('id',$id)->delete();
      }
      catch(\exception $ex)
      {
        return redirect()->back()->with('error','error while delete');
      }
      
   
   return redirect()->route('substitutions');
    }

    public function delete_all()
    {
    	$ids = $_POST['ids'];
        foreach($ids as $id)
        {
          try{
            Substitution::where('task_id',$id)->delete();
            $task=Tasks::where('id',$id)->delete();
          }
          catch(\exception $ex)
          {
            return redirect()->back()->with('error','error while delete');
          }
        } 
        return redirect()->route('substitutions');
    }

    public function excel()
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'substitutions' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];

            Excel::store(new SubstitutionsExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            
            Excel::store((new SubstitutionsExport($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            
            Excel::store((new SubstitutionsExport(null)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }
    }
}
