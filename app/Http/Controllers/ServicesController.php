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
use Excel;
use Session;

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
        $service->task_type_id = 3;
        $service->task_status_id = 1;
        $service->save();
        return redirect()->route('services_create')->with('success','تم إضافه خدمه جديد بنجاح');

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

    public function filter(Request $request)
    {
        if($request->filled('payment_status'))
        $data['services'] = Tasks::whereIn('task_payment_status_id',$request->payment_status)->get();
    else
        $data['services'] = Tasks::all();
    
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Tasks::find($id);
        $user->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            Tasks::find($id)->delete();
        } 
    }
}
