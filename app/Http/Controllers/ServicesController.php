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
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Specializations;
use App\SyndicateLevels;
use App\User_Ratings;
use App\Geo_Cities;
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(session('country') == null)
        // {
        //     return redirect()->route('choose.country');
        // }
        $data['services'] = Tasks::where('country_id',session('country'))->where('task_type_id', 3)->paginate(10);
        $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();
        return view('services.services', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['clients'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
            $q->where('rule_id', 6);
        })->get();
        $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();
        return view('services.services_create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'client_code' => 'required',
            'service_name' => 'required',
            'service_type' => 'required',
            'service_expenses' => 'required|numeric',
            'address'=>'required',
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
        $service->task_address = $request->address;
        $service->task_type_id = 3;
        $service->task_status_id = 1;
        $service->country_id=session('country');
        $service->save();
        return redirect()->route('services_show', $service->id)->with('success', 'تم إضافه خدمه جديد بنجاح');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['service'] = Tasks::where('task_type_id',3)->where('id',$id)->first();

        if( $data['service'] == NULL ) {
            Session::flash('warning', 'لم يتم العثور الخدمة');
            return redirect('/services');
        }

        $data['charges'] = Task_Charges::where('task_id', $id)->get();
        $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();
        $data['statuses'] = Entity_Localizations::where('entity_id', 4)->where('field', 'name')->get();
        $data['reports'] = Case_Techinical_Report::where('item_id', $id)->where('technical_report_type_id', 3)->get();
        // dd($data['reports']);
        return view('services.services_show', $data);
    }

    public function status(Request $request, $id)
    {
        $service = Tasks::find($id);
        $service->task_status_id = $request->service_status;
        $service->save();
        return redirect()->route('services_show', $id)->with('success', 'تم تغيير الحاله بنجاح');
    }

    public function charge(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'service_date' => 'required',
            'is_paid' => 'required',
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('services_show/' . $id . '#add_fees')
                ->withErrors($validator)
                ->withInput();
        }
        $charge = new Task_Charges;
        $charge->amount = $request->amount;
        $charge->date = date('Y-m-d H:i:s', strtotime($request->service_date));
        $charge->is_paid = $request->is_paid;
        $charge->reason = $request->reason;
        $service = Tasks::find($id);
        $service->charges()->save($charge);

        return redirect()->route('services_show', $id)->with('success', 'تم إضافه رسوم للخدمه بنجاح');
    }

    public function charge_status(Request $request, $id)
    {
        $charge = Task_Charges::find($id);
        $charge->is_paid = $request->is_paid;
        $charge->save();
        return redirect()->back()->with('success', 'تم تغيير الحاله بنجاح');
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

        if( $data['service'] == NULL ) {
            Session::flash('warning', 'لم يتم العثور الخدمة');
            return redirect('/services');
        }
        
        $data['clients'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
            $q->where('rule_id', 6);
        })->get();
        $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();

        return view('services.services_edit', $data);
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
            'client_code' => 'required',
            'service_name' => 'required',
            'service_type' => 'required',
            'service_expenses' => 'required|numeric',
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
        return redirect()->route('services')->with('success', 'تم تعديل بيانات الخدمه بنجاح');
    }

    public function excel()
    {

        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'services' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];
            Excel::store(new ServicesExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            Excel::store((new ServicesExport($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new ServicesExport()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }

    }

    public function excel2()
    {

        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'services' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];
            Excel::store(new ServicesExport2($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            Excel::store((new ServicesExport2($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new ServicesExport2()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }

    }

    public function filter(Request $request)
    {
        if ($request->filled('payment_status'))
            $data['services'] = Tasks::where('country_id',session('country'))->where('task_type_id', 3)->whereIn('task_payment_status_id', $request->payment_status);
        else
            $data['services'] = Tasks::where('country_id',session('country'))->where('task_type_id', 3);
        

        if($request->filled('search'))
        {
            $data['services'] = $data['services']->distinct()->where(function($query) use ($request){
                $query->where('name','like','%'.$request->search.'%')->orwhere(function($query) use ($request){
                $query->whereHas('client',function($q) use ($request){
                    
                        $q->where('full_name','like','%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%');
                   
                });
            }); 
        });
        }

            $data['services'] = $data['services']->paginate(10);

        $data['types'] = Entity_Localizations::where('entity_id', 9)->where('field', 'name')->get();

        foreach ($data['services'] as $service) {
            $filter_ids[] = $service->id;
        }
        if (!empty($filter_ids)) {
            Session::flash('filter_ids', $filter_ids);
        } else {
            $filter_ids[] = 0;
            Session::flash('filter_ids', $filter_ids);
        }

        return view('services.services', $data);
    }

    public function filter2(Request $request)
    {
        // $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        $data['services'] = Tasks::where('country_id',session('country'))->where(function ($q) use ($request) {
            $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
            $date_to = date('Y-m-d 23:59:59', strtotime($request->date_to));

            $q->where('task_type_id', 3);

            if ($request->filled('client_name')) {
                $q->whereHas('client', function ($q) use ($request) {
                    $q->where('full_name', 'like', '%' . $request->client_name . '%');

                });
            }

            if ($request->status == 1 || $request->status == 2) {
                $q->where('task_status_id', $request->status);

            }

            if ($request->lawyer == 1) {
                $q->whereNotNull('assigned_lawyer_id');
            } elseif ($request->lawyer == 0) {
                $q->whereNull('assigned_lawyer_id');
            }

            if ($request->filled('date_from') && $request->filled('date_to')) {
                $q->whereBetween('start_datetime', array($date_from, $date_to));
            } elseif ($request->filled('date_from')) {
                $q->where('start_datetime', '>=', $date_from);
            } elseif ($request->filled('date_to')) {
                $q->where('start_datetime', '<=', $date_to);
            }




        })->paginate(10);
        $data['statuses'] = Entity_Localizations::where('entity_id', 4)->where('field', 'name')->get();
        $data['courts'] = Courts::where('country_id',session('country'))->get();
        $data['regions'] = Case_::all('region');
        $data['sessions'] = Tasks::where('country_id',session('country'))->where('task_type_id', 2)->get();
        $data['tab']=2;
        return view('tasks.tasks_normal', $data);
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
        Task_Charges::where('task_id', $id)->delete();

    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            Tasks::find($id)->delete();
            Task_Charges::where('task_id', $id)->delete();
        }
    }

    public function download_document($id)
    {
        $document = Case_Techinical_Report_Document::find($id);
        $file = public_path() . "/" . $document->file;
        if(file_exists($file)){
            
            return response()->download($file, $document->name);
        }
        return redirect()->back();
    }

    public function download_all_documents($id)
    {
        $zipper = new \Chumper\Zipper\Zipper;

        
        $report = Case_Techinical_Report::where('item_id', $id)->where('technical_report_type_id', 3)->with('case_tachinical_report_documents')->get(); 
        foreach ($report as $rep) {
            foreach($rep->case_tachinical_report_documents as $document)     
            $file = $document->file;
            $zipper->zip('technical_reports.zip')->add($file);

        }
        $zipper->close();
        return response()->download(public_path() . "/technical_reports.zip")->deleteFileAfterSend(true);
    }

    public function lawyer($id)
    {
        $data['types'] = Rules::where('parent_id', 5)->get();
        $data['lawyers'] = Users::where('country_id',session('country'))->whereHas('rules', function ($q) {
            $q->where('rule_id', 5);
        })->where('is_active', 1)->paginate(10);
        $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
        $data['service'] = Tasks::find($id);
        $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
        $data['types'] = Rules::where('parent_id', 5)->get();
        $data['work_sectors'] = Specializations::all();
        $data['syndicate_levels'] = SyndicateLevels::all();
        $data['cities']=Geo_Cities::where('country_id',session('country'))->get();
        return view('services.services_lawyer', $data);
    }

    public function lawyer_task($id)
    {
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
        $div = view('services.services_lawyer_tasks', $data)->render();
        return response()->json($div);
    }

    public function filter_lawyer(Request $request, $id)
    {
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
         */
        $data['service']=Tasks::where('id',$id)->first();
        $data['lawyers'] = Users::where('country_id',session('country'))->where(function ($q) use ($request) {
            if($request->has('search'))
            {
              $q = $q->where(function($query) use ($request){
                $query->where('name','like','%'.$request->search.'%')->orwhere('full_name','like','%'.$request->search.'%')->orwhere('code','like','%'.$request->search.'%')->orwhere('cellphone','like','%'.$request->search.'%');
              });
            }
          $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
          $date_to = date('Y-m-d 23:59:59', strtotime($request->date_to));
    
         
          if ($request->has('nationalities') && $request->nationalities != 0) {
            $q->whereHas('user_detail', function ($q) use ($request) {
              $q->where('nationality_id', $request->nationalities);
    
            });
          }
          if ($request->has('work_sector_area_id') && $request->work_sector_area_id != 0) {
            $q->whereHas('user_detail', function ($q) use ($request) {
              $q->where('work_sector_area_id', $request->work_sector_area_id);
    
            });
          }
          if ($request->has('experience') && $request->experience != null) {
            $q->whereHas('user_detail', function ($q) use ($request) {
              $q->where('experience', $request->experience);
    
            });
          }
          if ($request->has('consultation_cost') && $request->consultation_cost != null) {
            $q->whereHas('user_detail', function ($q) use ($request) {
              $q->where('consultation_price', $request->consultation_cost);
    
            });
          }
    
          if ($request->filled('work_sector')) {
            $q->whereHas('specializations', function ($q) use ($request) {
              $q->whereIn('specializations.id',$request->work_sector);
    
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
         
    
    
    
          })->whereHas('rules',function($q)use($request){
          if ($request->has('types') && $request->types != 0) {
           
              $q->where('rule_id', $request->types);
    
            
          } else {
           
              $q->where('parent_id', 5);
            
          }
          })->paginate(10);
        
            $data['roles'] = Rules::whereBetween('id', array('2', '4'))->get();
            $data['nationalities'] = Entity_Localizations::where('field', 'nationality')->where('entity_id', 6)->get();
            $data['types'] = Rules::whereBetween('id', array('11', '12'))->get();
            $data['work_sectors'] = Specializations::all();
            $data['syndicate_levels'] = SyndicateLevels::all();
            $data['cities']=Geo_Cities::where('country_id',session('country'))->get();
            foreach ($data['lawyers'] as $lawyer) {
              $filter_ids[] = $lawyer->id;
            }
            if (!empty($filter_ids)) {
              Session::flash('filter_ids', $filter_ids);
            } else {
              $filter_ids[] = 0;
              Session::flash('filter_ids', $filter_ids);
            }

        return view('services.services_lawyer', $data);

    }

    public function assign(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'lawyer' => 'required',
        ], [
            'lawyer.required' => 'من فضلك اختر محامى ',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $date = explode('-', $request->start_end);
        $start = date('Y-m-d', strtotime($date[0]));
        $end = date('Y-m-d', strtotime($date[1]));

        $service = Tasks::find($id);
        $service->assigned_lawyer_id = $request->lawyer;
        $service->who_assigned_lawyer_id = \Auth::user()->id;
        $service->start_datetime = $start;
        $service->end_datetime = $end;
        $service->task_assignment_date = Carbon::now()->format('Y-m-d H:i:s');
        $service->country_id=session('country');
        $service->save();
        $user = Users::find($request['lawyer']);
        $notification_type = Notification_Types::find(12);
        $notification = Notifications::create([
            "msg" => $notification_type->msg,
            "entity_id" => 11,
            "item_id" => $id,
            "user_id" => $request['lawyer'],
            "notification_type_id" => 12,
            "is_read" => 0,
            "is_sent" => 0,
            'is_push'=>$notification_type->is_push,
            "created_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $notification_push = Notifications_Push::create([
            "notification_id" => $notification->id,
            "device_token" => $user->device_token,
            "mobile_os" => $user->mobile_os,
            "lang_id" => $user->lang_id,
            "user_id" => $request['lawyer']
        ]);
        return redirect()->route('tasks_normal')->with('success', 'تم تعيين محامى بنجاح');
    }

    public function addServiceReport(Request $request){

        $validator = Validator::make($request->all(), [
                'report_file' => 'required|max:3000',
                'report_desc' => 'required',
                'service_id' => 'required',
                '_token' => 'required',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $case_report = Case_Techinical_Report::create([
                'technical_report_type_id' => 3,
                'item_id' => $request->service_id,
                'body' => $request->report_desc,
                'created_by' => \Auth::user()->id,
              ]);
              
              if ($request->hasFile('report_file')) {
      
               
      
                    $destinationPath = 'reports';
                    $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $request->report_file->getClientOriginalExtension();
         
                    Input::file('report_file')->move($destinationPath, $fileNameToStore);
      
                   
                    Case_Techinical_Report_Document::create([
                      'case_techinical_report_id' => $case_report->id,
                      'file' => $fileNameToStore,
                    ]);
                
    
            }
            return redirect()->back();
    }


}
