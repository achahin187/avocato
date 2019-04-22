<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Excel;
use App\Exports\ConsultationTypesExport;
use App\Consultation_Types;
use Illuminate\Http\Request;
use App\Languages;
use App\Helpers\Helper;

class ConsultationsClassificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('consultations_classification')
                ->with('consultations', Consultation_Types::all())
                ->with('languages', Languages::all());
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
        // Validation
        $validator =  Validator::make($request->all(), [
            'consult_name'  => 'required'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('/consultations_classification#popupModal_1')
                            ->withErrors($validator)
                            ->withInput();
        }

        // Add values
        Consultation_Types::create([
            'name' => $request->consult_name
        ]);

        // redirect back with flash message
        Session::flash('success', 'تم إضافة تصنيف إستشاري بنجاح');
        return redirect('/consultations_classification');
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
        // Find and delete this record
        Consultation_Types::destroy($id);
        Helper::remove_related_localization('formula_contract_types', $id);
        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    /**
     * Delete selected rows
     */
    public function destroySelected(Request $request) 
    {
        // get cities IDs from AJAX
        $ids = $request->ids;
        foreach($ids as $id){
            // Find and delete this record
            Consultation_Types::destroy($id);
            Helper::remove_related_localization('formula_contract_types', $id);
        }
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'Consultation_Classifications_'.time().'.xlsx';

        if(isset($request->ids)){
            $ids = explode(",", $request->ids);

            Excel::store(new ConsultationTypesExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new ConsultationTypesExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }
    
    public function add_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'consult_id' => 'required|integer',
            'consult_name'=>'required',
            'lang_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('consultations_classification#lang')->withErrors($validator)->withInput();
        }
        Helper::add_localization('consultation_types', 'name', $request->consult_id, $request->consult_name, $request->lang_id);
        return redirect()->route('consultations_classification')->with('success','تم الإضافة بنجاح');
    }
}
