<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\User_Details;
use Helper;
use Excel;
use Session;
use App\Procurations;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Exports\LawyersExport;
use Jenssegers\Date\Date;
use Validator;

class ProcurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       // dd($request);
      $validator = Validator::make($request->all(), [
      'client_id' => 'required',
      'procuration_number' => 'required',
      'procuration_type' => 'required',
      'issue_date' => 'required',
      'office' => 'required',
      //'photo' => 'required',
      'route_name'=>'required',

    ]);

      //switchcase for rout_name... no there is \URL::route($route, [], false); 

    if ($validator->fails()) {
      // return redirect()->back()
      //   ->withErrors($validator)
      //   ->withInput();
         return redirect(\URL::route($request->route_name, $request->client_id, false).'#popupModal_2')->withErrors($validator)
          ->withInput();
    }

    if ($request->hasFile('photo')) {
      $destinationPath = 'users_images';
      $image_name = $destinationPath . '/' . $request->procuration_number . time() . rand(111, 999) . '.' . Input::file('photo')->getClientOriginalExtension();
      Input::file('photo')->move($destinationPath, $image_name);
    }

  // id   client_id   procuration_number  procuration_type    issue_date  office  photo   created_at  updated_at  created_by  updated_by
 

    $procuration = new Procurations;
    $procuration->client_id = $request->client_id ;
    $procuration->procuration_number = $request->procuration_number;
    $procuration->procuration_type = $request->procuration_type;
    $procuration->issue_date = date('Y-m-d H:i:s', strtotime($request->issue_date));
    $procuration->office = $request->office;
    $procuration->photo = $request->photo;
    $procuration->created_at =date('Y-m-d H:i:s');
    $procuration->created_by = \Auth::user()->id;
    $procuration->save();
   // we will send the route name related to section ex : companies.show
    return redirect()->route($request->route_name, $request->client_id)->with('success', 'تم إضافه توكيل جديد بنجاح');
  
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
