<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specializations;
use App\Languages;
use Validator;
use Excel;
use App\Exports\SpecializationsExport;
use Session;
use App\Helpers\Helper;

class SpecializationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['specializations'] = Specializations::all();
        $data['languages'] = Languages::all();
        return view('specializations',$data);
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

    public function excel()
    {   
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'specializations'.time().'.xlsx';
        if(isset($_GET['ids'])){
            $ids = $_GET['ids'];
            Excel::store(new SpecializationsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        }   
        else{
            Excel::store((new SpecializationsExport()),$filepath.$filename);
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
            'new_specialization'=>'required|unique:specializations,name',
        ]);

        if ($validator->fails()) {
            return redirect('specializations#popupModal_1')
                        ->withErrors($validator)
                        ->withInput();
        }

        $specialization = new Specializations;
        $specialization->name = $request->new_specialization;
        $specialization->save();
        return redirect()->route('specializations')->with('success','تم إضافة تخصص جديد بنجاح');
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
       $specialization=Specializations::find($id);
       Helper::remove_related_localization('specializations', $specialization->id);
       $specialization->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        
        foreach($ids as $id)
           {
                
                $specialization = Specializations::find($id);
                if($specialization){
                    $specialization->delete();
                    Helper::remove_related_localization('specializations', $specialization->id);
                }
           } 
    }

    public function add_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'specialization_id' => 'required|integer',
            'specialization_name'=>'required',
            'lang_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('specializations#lang')->withErrors($validator)->withInput();
        }
        Helper::add_localization('specializations', 'name', $request->specialization_id, $request->specialization_name, $request->lang_id);
        return redirect()->route('specializations')->with('success','تم الإضافة بنجاح');
    }
}
