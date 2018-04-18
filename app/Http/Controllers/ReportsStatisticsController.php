<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Helper;

use App\Case_;
use App\Users;
use App\Tasks;

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
        $count_clients = Helper::getUsersBasedOnRules([7, 8, 9, 10])->count();  // count all clients

        // mobile clients number and percentage
        $count_mobile = Users::users(7)->count();
        $percentage_mobile = Helper::percent($count_mobile, $count_clients);

        // individuals number and percentage
        $count_individuals = Users::users(8)->count();
        $percentage_individuals = Helper::percent($count_individuals, $count_clients);

        // companies number and percentage
        $count_companies = Users::users(9)->count();
        $percentage_companies = Helper::percent($count_companies, $count_clients);
        
        // individuals-companies number and percentage
        $count_indcom = Users::users(10)->count();
        $percentage_indcom = Helper::percent($count_indcom, $count_clients);
        
        // cases number & percentage
        $cases = Case_::all();
        $count_case = Case_::count();

        // paid services
        $count_paid_services = Tasks::where('task_type_id', 3)->where('task_payment_status_id', 2)->count();
        // free services
        $count_free_services = Tasks::where('task_type_id', 3)->where('task_payment_status_id', 1)->count();

        // Lawyers
        $lawyers = Helper::getUsersBasedOnRules([11, 12]);

        // Companies

        // Installments

        // Urgents

        // Locations

        return view('reports_statistics', compact([
                                        'count_clients', 'count_individuals', 'percentage_individuals', 
                                        'count_companies', 'percentage_companies', 'count_indcom', 'percentage_indcom', 
                                        'count_mobile', 'percentage_mobile', 'count_case', 'count_paid_services', 'count_free_services',
                                        'cases', 'lawyers'
                                    ]));
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
}
