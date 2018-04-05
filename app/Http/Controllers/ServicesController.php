<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Tasks;
use App\Task_Payment_Statuses;
use App\Entity_Localizations;
use Validator;

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
    public function show()
    {
        return view('services.services_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('services.services_edit');
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
}
