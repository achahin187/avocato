<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Courts;
use App\Case_;
use App\Entity_Localizations;
use Excel;
use Session;
use App\Exports\SessionsExport;
use App\Users;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function normal_index()
    {
        $data['sessions'] = Tasks::where('task_type_id',2)->get();
        $data['services'] = Tasks::where('task_type_id',3)->get();
        $data['regions'] = Case_::all('region');
        // $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        $data['statuses'] = Entity_Localizations::where('entity_id',4)->where('field','name')->get();
        $data['courts'] = Courts::all(); 
        return view('tasks.tasks_normal',$data);
    }

    public function emergency_index()
    {
        $data['tasks']=Tasks::where('task_type_id',1)->get();
        $data['clients']=Users::whereHas('rules', function ($query) {
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
        // $data['client_type']=(object)$data['client_type'];
             // dd($data['clients']);
        return view('tasks.tasks_emergency',$data);
    }

            public function excel()
    { 

      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'sessions'.time().'.xlsx';
      if(isset($_GET['ids'])){
       $ids = $_GET['ids'];
       Excel::store(new SessionsExport($ids),$filepath.$filename);
       return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      Excel::store((new SessionsExport($filters)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }
    else{
      Excel::store((new SessionsExport()),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
    }

    }

    public function filter(Request $request)
    { 
        $data['sessions'] = Tasks::where(function($q) use($request){

            $q->where('task_type_id',2);

            $start_from=date('Y-m-d H:i:s',strtotime($request->start_from));
            $start_to=date('Y-m-d 23:59:59',strtotime($request->start_to));
            $next_from=date('Y-m-d H:i:s',strtotime($request->next_from));
            $next_to=date('Y-m-d 23:59:59',strtotime($request->next_to));

            if($request->has('courts'))
            {
               $q->whereHas('case',function($q) use($request){
                $q->whereHas('courts',function($q)use($request){
                    $q->whereIn('id',$request->courts);
                });

            }); 
           }

           if($request->has('regions'))
           {
               $q->whereHas('case',function($q) use($request){
                $q->whereIn('region',$request->regions);

            }); 
           }



           if($request->lawyer == 1)
           {
              $q->whereNotNull('assigned_lawyer_id');
           }
           elseif($request->lawyer == 0)
           {
            $q->whereNull('assigned_lawyer_id');
           }

     if($request->filled('start_from') && $request->filled('start_to') )
     {
        $q->whereBetween('start_datetime', array($start_from, $start_to));
    }
    elseif($request->filled('start_from'))
    {
        $q->where('start_datetime','>=',$start_from);
    }
    elseif($request->filled('start_to'))
    {
        $q->where('start_datetime','<=',$start_to);
    }

    if($request->filled('next_from') && $request->filled('next_to') )
     {
        $q->whereBetween('next_datetime', array($next_from, $next_to));
    }
    elseif($request->filled('next_from'))
    {
        $q->where('next_datetime','>=',$next_from);
    }
    elseif($request->filled('next_to'))
    {
        $q->where('next_datetime','<=',$next_to);
    }



        })->get();

            foreach($data['sessions'] as $session)
            {
                $filter_ids[]=$session->id;
            }
            if(!empty($filter_ids))
            {
                Session::flash('filter_ids',$filter_ids);
            }
            else{
                $filter_ids[]=0;
                Session::flash('filter_ids',$filter_ids);
            }
        $data['services'] = Tasks::where('task_type_id',3)->get();
        $data['regions'] = Case_::all('region');
        // $data['types'] = Entity_Localizations::where('entity_id',9)->where('field','name')->get();
        $data['statuses'] = Entity_Localizations::where('entity_id',4)->where('field','name')->get();
        $data['courts'] = Courts::all(); 
        return view('tasks.tasks_normal',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      Tasks::find($id)->delete();

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
