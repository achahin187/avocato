<?php

namespace App\Http\Controllers;

use Excel;
use App\Users;
use App\Exports\ClientsExport;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.content');
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

    public function printSelected($ids) 
    {
        if ( isset($ids) && !empty($ids) ) {
            return view('clients.print_card')->with('users', Users::whereIn('id', explode(",", $ids) )->get());
        } else {
            return redirect()->back();
        }
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = $request->userType.time().'.xlsx';

        if(isset($request->ids)){
            $ids = explode(",", $request->ids);

            Excel::store(new ClientsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new ClientsExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }

}
