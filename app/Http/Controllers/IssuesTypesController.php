<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cases_Types;
use Validator;
use Excel;
use App\Exports\CasesTypesExport;
use App\Languages;
use Session;
use App\Helpers\Helper;
use App;

class IssuesTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['issues'] = Cases_Types::all();
        $data['languages'] = Languages::all();
        return view('issues_types',$data);
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
        $filename = 'cases'.time().'.xlsx';
        if(isset($_GET['ids'])){
           $ids = $_GET['ids'];
        Excel::store(new CasesTypesExport($ids),$filepath.$filename);
        return response()->json($PathForJson.$filename);
    }
        else{
        Excel::store((new CasesTypesExport()),$filepath.$filename);
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
            'new_type'=>'required|unique:cases_types,name'
        ]);

        if ($validator->fails()) {
            return redirect('issues_types#popupModal_1')->withErrors($validator)->withInput();
        }
        $issue = new Cases_Types;
        $issue->name = $request->new_type;
        $issue->save();
        // if($request->lang_id != 1){
            // Helper::add_localization('cases_types', 'name', $issue->id, $issue->name, $request->lang_id);
        // }
        return redirect()->route('issues_types')->with('success','تم إضافه نوع جديد بنجاح');
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
       $issue = Cases_Types::find($id);
       Helper::remove_related_localization('cases_types', $issue->id);
       $issue->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
           {
                Helper::remove_related_localization('cases_types', $id);
                Cases_Types::find($id)->delete();
           } 
    }

    public function add_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'issue_id' => 'required|integer',
            'case_type'=>'required',
            'lang_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('issues_types#lang')->withErrors($validator)->withInput();
        }
        Helper::add_localization('cases_types', 'name', $request->issue_id, $request->case_type, $request->lang_id);
        return redirect()->route('issues_types')->with('success','تم الإضافة بنجاح');
    }

    public function changeLanguage(Request $request)
    {
        Session::put('AppLocale', $request->locale);
        return response()->json(['lang' => $request->locale]);
    }
}
