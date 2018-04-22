<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Helper;

use App\Case_;
use App\Users;
use App\Tasks;
use App\Installment;
use App\Courts;
use App\Cases_Types;
use App\Geo_Cities;
use App\Geo_Governorates;

use Illuminate\Http\Request;

class ReportsStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->getData();

        return view('reports_statistics', $data);
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
        //
    }

    public function getData($filters = NULL) 
    {
        /** Filter data */
        $data['governorates'] = Geo_Governorates::all();
        $data['cities'] = Geo_Cities::all();

        /** Countable and percentage data */
        // list data
        $data['count_clients'] = Helper::getUsersBasedOnRules([7, 8, 9, 10])->count();  // count all clients

        // mobile clients number and percentage
        $data['count_mobile'] = Users::users(7)->count();
        $data['percentage_mobile'] = Helper::percent($data['count_mobile'], $data['count_clients']);

        // individuals number and percentage
        $data['count_individuals'] = Users::users(8)->count();
        $data['percentage_individuals'] = Helper::percent($data['count_individuals'], $data['count_clients']);

        // companies number and percentage
        $data['count_companies'] = Users::users(9)->count();
        $data['percentage_companies'] = Helper::percent($data['count_companies'], $data['count_clients']);
        
        // individuals-companies number and percentage
        $data['count_indcom'] = Users::users(10)->count();
        $data['percentage_indcom'] = Helper::percent($data['count_indcom'], $data['count_clients']);
        
        /** List data */
        // cases number & percentage
        if($filters) { 
            if(isset($filters['gov'])) { $data['cases'] = Case_::whereIn('geo_governorate_id', $filters['gov']); }
            if(isset($filters['city'])){ $data['cases'] = Case_::whereIn('geo_city_id', $filters['city']); }
        } else {
            $data['cases'] = Case_::all();
        }
        $data['count_case'] = Case_::count();

        // paid services
        $data['count_paid_services'] = Tasks::where('task_type_id', 3)->where('task_payment_status_id', 2)->count();
        // free services
        $data['count_free_services'] = Tasks::where('task_type_id', 3)->where('task_payment_status_id', 1)->count();

        // Lawyers
        $data['lawyers'] = Helper::getUsersBasedOnRules([11, 12]);

        // Companies
        $data['companies'] = Users::users(9)->get();
        
        // Installments
        $data['installments'] = Installment::all();

        // Urgents
        $data['urgents'] = Helper::getUsersBasedOnRules([7, 8, 9, 10]);

        // Courts
        $data['courts'] = Courts::all();

        // Tasks
        $data['tasks'] = Tasks::all();

        // Case type
        $data['casesTypes'] = Cases_Types::all();

        return $data;
    }

    public function filter(Request $request) {
        if(count($request->all()) > 1) { 
            if($request->gov || $request->city) { $data = $this->getData(['gov' => $request->gov, 'city' => $request->city]); }

        } else {
            $data = $this->getData();
        }

        return view('reports_statistics', $data);
    }
}
