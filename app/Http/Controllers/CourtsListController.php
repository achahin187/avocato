<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Geo_Governorates;
use App\Geo_Cities;
use App\Courts;
use Validator;
use Excel;
use App\Exports\CourtsExport;

class CourtsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['courts'] = Courts::all();
        $data['govs'] = Geo_Governorates::all();
        return view('courts_list',$data);
    }

    public function getCity(Request $request){
        $cities= Geo_Cities::where('governorate_id', $request->id)->pluck('name', 'id');
        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function excel(Request $request)
    {   
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'courts'.time().'.xlsx';
        
        if(isset($_GET['ids'])){
            $ids = explode(",", $request->ids);
            Excel::store(new CourtsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else { 
        Excel::store((new CourtsExport()),$filepath.$filename);
        return response()->json($PathForJson.$filename); 
      }
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
            'court'=>'required',
            'govs'=>'required',
            'cities'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('courts_list#popupModal_1')
            ->withErrors($validator)
            ->withInput();
        }
        $court = new Courts;
        $court->name= $request->court;
        $court->city_id = $request->cities;
        $court->save();
        return redirect()->route('courts_list')->with('success','تم إضافه محكمه جديده بنجاح');

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
       $court=Courts::find($id);
       $court->delete();
    }

        public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
           {
            Courts::find($id)->delete();
           } 
    }

}
