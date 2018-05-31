<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Tasks;
use App\Task_Payment_Statuses;
use App\Entity_Localizations;
use App\Task_Charges;
use Validator;
use App\Exports\ServicesExport;
use App\Exports\ServicesExport2;
use Excel;
use Session;
use App\Case_Techinical_Report_Document;
use App\Case_Techinical_Report;
use Jenssegers\Date\Date;
use App\Rules;
use App\Courts;
use App\Case_;
use App\Notification_Types;
use App\Notifications;
use App\Notifications_Push;
use App\Carbon;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $data['services'] = Tasks::where('task_type_id',3)->get();
        $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        return view('services.services',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['clients'] = Users::whereHas('rules',function($q){
            $q->where('rule_id',6);
        })->get();
        $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        return view('services.services_create',$data);
        
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
            'client_code'=>'required',
            'service_name'=>'required',
            'service_type'=>'required',
            'service_expenses'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $service = new Tasks;
        $service->client_id = $request->client_code;
        $service->name = $request->service_name;
        $service->task_payment_status_id = $request->service_type;
        $service->expenses = $request->service_expenses;
        $service->start_datetime = date('Y-m-d');
        $service->end_datetime = date('Y-m-d');
        $service->task_type_id = 3;
        $service->task_status_id = 1;
        $service->save();
        return redirect()->route('services_show',$service->id)->with('success','تم إضافه خدمه جديد بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['service'] = Tasks::find($id);
        $data['charges'] = Task_Charges::where('task_id',$id)->get();
        $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        $data['statuses'] = Entity_Localizations::where('entity_id',4)->where('field','name')->get();
        $data['reports'] = Case_Techinical_Report::where('item_id',$id)->where('technical_report_type_id',3)->get();
        return view('services.services_show',$data);
    }

        public function status(Request $request,$id)
    {
        $service = Tasks::find($id);
        $service->task_status_id = $request->service_status;
        $service->save();
        return redirect()->route('services_show',$id)->with('success','تم تغيير الحاله بنجاح');
    }

        public function charge(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'amount'=>'required',
            'service_date'=>'required',
            'is_paid'=>'required',
            'reason'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('services_show/'.$id.'#add_fees')
            ->withErrors($validator)
            ->withInput();
        }
        $charge = new Task_Charges;
        $charge->amount = $request->amount;
        $charge->date = date('Y-m-d H:i:s',strtotime($request->service_date));
        $charge->is_paid = $request->is_paid;
        $charge->reason = $request->reason;
        $service = Tasks::find($id);
        $service->charges()->save($charge);

        return redirect()->route('services_show',$id)->with('success','تم إضافه رسوم للخدمه بنجاح');
    }

        public function charge_status(Request $request,$id)
    {
        $charge = Task_Charges::find($id);
        $charge->is_paid = $request->is_paid;
        $charge->save();
        return redirect()->back()->with('success','تم تغيير الحاله بنجاح');
    }

        public function charge_destroy($id)
    {
        $charge = Task_Charges::find($id);
        $charge->delete();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['service'] = Tasks::find($id); 
        $data['clients'] = Users::whereHas('rules',function($q){
            $q->where('rule_id',6);
        })->get();
        $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();

        return view('services.services_edit',$data);
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
            'client_code'=>'required',
            'service_name'=>'required',
            'service_type'=>'required',
            'service_expenses'=>'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $service = Tasks::find($id);
        $service->client_id = $request->client_code;
        $service->name = $request->service_name;
        $service->task_payment_status_id = $request->service_type;
        $service->expenses = $request->service_expenses;
        // $service->task_type_id = 3;
        // $service->task_status_id = 1;
        $service->save();
        return redirect()->route('services')->with('success','تم تعديل بيانات الخدمه بنجاح');
    }

        public function excel()
    { 

      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'services'.time().'.xlsx';
      if(isset($_GET['ids'])){
       $ids = $_GET['ids'];
       Excel::store(new ServicesExport($ids),$filepath.$filename);
       return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      Excel::store((new ServicesExport($filters)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
    else{
      Excel::store((new ServicesExport()),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }

    }

            public function excel2()
    { 

      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'services'.time().'.xlsx';
      if(isset($_GET['ids'])){
       $ids = $_GET['ids'];
       Excel::store(new ServicesExport2($ids),$filepath.$filename);
       return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      Excel::store((new ServicesExport2($filters)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
    else{
      Excel::store((new ServicesExport2()),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }

    }

    public function filter(Request $request)
    {
        if($request->filled('payment_status'))
        $data['services'] = Tasks::where('task_type_id',3)->whereIn('task_payment_status_id',$request->payment_status)->get();
    else
        $data['services'] = Tasks::where('task_type_id',3)->get();
    
        $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();

                    foreach($data['services'] as $service)
            {
                $filter_ids[]=$service->id;
            }
            if(!empty($filter_ids))
            {
                Session::flash('filter_ids',$filter_ids);
            }
            else{
                $filter_ids[]=0;
                Session::flash('filter_ids',$filter_ids);
            }

        return view('services.services',$data);
    }

        public function filter2(Request $request)
    {
        // $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        $data['services'] = Tasks::where(function($q) use($request){
              $date_from=date('Y-m-d H:i:s',strtotime($request->date_from));
              $date_to=date('Y-m-d 23:59:59',strtotime($request->date_to));

               $q->where('task_type_id',3);

              if($request->filled('client_name'))
              {
               $q->whereHas('client',function($q) use($request){
                $q->where('full_name','like','%'.$request->client_name.'%');

              });  
             }

            if($request->status == 1 || $request->status == 2)
            {
              $q->where('task_status_id',$request->status);
 
            }

           if($request->lawyer == 1)
           {
              $q->whereNotNull('assigned_lawyer_id');
           }
           elseif($request->lawyer == 0)
           {
            $q->whereNull('assigned_lawyer_id');
           }

           if($request->filled('date_from') && $request->filled('date_to') )
           {
            $q->whereBetween('start_datetime', array($date_from, $date_to));
          }
          elseif($request->filled('date_from'))
          {
            $q->where('start_datetime','>=',$date_from);
          }
          elseif($request->filled('date_to'))
          {
            $q->where('start_datetime','<=',$date_to);
          }




        })->get();
        $data['statuses'] = Entity_Localizations::where('entity_id',4)->where('field','name')->get();
        $data['courts'] = Courts::all(); 
        $data['regions'] = Case_::all('region');
        $data['sessions'] = Tasks::where('task_type_id',2)->get();
        return view('tasks.tasks_normal',$data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Tasks::find($id)->delete();
      Task_Charges::where('task_id',$id)->delete();

    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
          Tasks::find($id)->delete();
          Task_Charges::where('task_id',$id)->delete();
        } 
    }

        public function download_document($id)
    {
        $document = Case_Techinical_Report_Document::find($id);
        $file= public_path()."/".$document->file;

    return response()->download($file, $document->name);
    }

    public function download_all_documents($id)
    {
        // \File::delete(public_path().'/technical_reports.zip');
        $zipper = new \Chumper\Zipper\Zipper;

        $report = Case_Techinical_Report::where('id',$id)->first();
        foreach ($report->case_tachinical_report_documents as  $document) {
            $file=  $document->file;
           $zipper->zip('technical_reports.zip')->add($file);
           
        }
        $zipper->close();
         return response()->download(public_path()."/technical_reports.zip")->deleteFileAfterSend(true);
    }

        public function lawyer($id)
    { 
      $data['types']=Rules::where('parent_id',5)->get();
      $data['lawyers'] = Users::whereHas('rules', function($q){
            $q->where('rule_id',5);
        })->where('is_active',1)->get();
      $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
      $data['service'] = Tasks::find($id);
      return view('services.services_lawyer',$data);
    }

        public function lawyer_task($id)
    { 
      Date::setLocale('ar');
      $tasks = Tasks::where('assigned_lawyer_id',$id)->get();
           if(count($tasks)){
      foreach($tasks as $task){
      $tasks_months[Date::parse($task->start_datetime)->format('F')][] = [
                              'id'=>$task->id,
                              'name'=>$task->name,
                              'start_datetime'=>$task->start_datetime,
                              'end_datetime'=>$task->end_datetime,
                              'task_type_id'=>$task->task_type_id,
                                    ];
      }
    }
        else
    {
      $tasks_months=[];
    }
      $data['tasks_months'] = $tasks_months;
      $div = view('services.services_lawyer_tasks',$data)->render();
      return response()->json($div);
    }

    public function filter_lawyer(Request $request,$id){
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
        $data['types']=Rules::where('parent_id',5)->get();
             $data['nationalities'] = Entity_Localizations::where('field','nationality')->where('entity_id',6)->get();
              $data['service'] = Tasks::find($id);

            return view('services.services_lawyer',$data);

          }

        public function assign(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'lawyer'=>'required',
        ],[
            'lawyer.required' => 'من فضلك اختر محامى ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }
      $date = explode('-',$request->start_end);  
      $start = date('Y-m-d',strtotime($date[0]));
      $end = date('Y-m-d',strtotime($date[1]));

      $service = Tasks::find($id);
      $service->assigned_lawyer_id = $request->lawyer;
      $service->who_assigned_lawyer_id = \Auth::user()->id;
      $service->start_datetime = $start;
      $service->end_datetime = $end;
      $service->save();
      $user=Users::find($request['lawyer']);
      $notification_type=Notification_Types::find(12);
      $notification=Notifications::create([
                "msg"=>$notification_type->msg,
                "entity_id"=>11,
                "item_id"=>$id,
                "user_id"=>$request['lawyer'],
                "notification_type_id"=>12,
                "is_read"=>0,
                "is_sent"=>0,
                "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
            ]);
             $notification_push=Notifications_Push::create([
                "notification_id"=>$notification->id,
                "device_token"=>$user->device_token,
                "mobile_os"=>$user->mobile_os,
                "lang_id"=>$user->lang_id,
                "user_id"=>$request['lawyer']
            ]);
      return redirect()->back()->with('success','تم تعيين محامى بنجاح');
    }


}
