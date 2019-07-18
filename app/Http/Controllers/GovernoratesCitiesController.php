<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Excel;
use App\Languages;
use App\Exports\GovernoratesCitiesExport;
use App\Geo_Cities;
use App\Geo_Governorates;
use Illuminate\Http\Request;
use App\Helpers\Helper;

class GovernoratesCitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all cities and governments
        return view('governorates_cities')->with('cities', Geo_Cities::where('country_id',session('country'))->get())
                                        ->with('governments', Geo_Governorates::where('country_id',session('country'))->get())
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
     * Store governments
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGovernment(Request $request)
    {
        // Validation
        $validator =  Validator::make($request->all(), [
            'gov_name'  => 'required|unique:geo_governorates,name'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('/governorates_cities#add_govenment')->withErrors($validator)->withInput();
        }

        // Add values
        Geo_Governorates::create([
            'name' => $request->gov_name,
            'country_id'=>session('country')
        ]);

        // redirect back with flash message
        Session::flash('success', 'تم إضافة المحافظة بنجاح');
        return redirect('/governorates_cities');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCity(Request $request)
    {
        // Validation
        $validator =  Validator::make($request->all(), [
            'government_id'  => 'required',
            'add_city'      => 'required|unique:geo_cities,name'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('/governorates_cities#add_city')->withErrors($validator)->withInput();
        }
        $gov = Geo_Governorates::find($request->government_id);
        // Add values
        try{
            Geo_Cities::create([
                'governorate_id' => $request->government_id,
                'name'           => $request->add_city,
                'country_id'=> $gov->country_id
            ]);
            Session::flash('success', 'تم إضافة المدينة بنجاح');
        }
        catch(\Exception $ex)
        {
            Session::flash('error', 'حدث خطأ'.$ex);
        }
        
        // redirect back with flash message
        if($request->addMore == 1) {
            return redirect('/governorates_cities#add_city')->withErrors(['government_id' => 'اضف المزيد', 'add_city' => 'اضف المزيد']);
        }

        return redirect('/governorates_cities');
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
    public function destroy_governate(Request $request)
    {
        // Find and delete this record
        Helper::remove_related_localization('geo_governorates', $request->id);
        Geo_Governorates::find($request->id)->delete();
        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function destroy_city(Request $request)
    {
        // Find and delete this record
        Helper::remove_related_localization('geo_cities', $request->id);
        Geo_Cities::find($request->id)->delete();
        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
    /**
     * Delete selected rows
     */
    public function destroyAllgovernate(Request $request) 
    {
        // get cities IDs from AJAX
        $ids = $request->ids;
        foreach($ids as $id){
            Helper::remove_related_localization('geo_governorates', $id);
            Geo_Governorates::find($id)->delete();
        }
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }
    
   public function destroyAllcity(Request $request) 
   {
       // get cities IDs from AJAX
       $ids = $request->ids;
       foreach($ids as $id){
           Helper::remove_related_localization('geo_cities', $id);
           Geo_Cities::find($id)->delete();
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
        if($_GET['is_city'] == 1)
        {
            $filename = 'Cities'.time().'.xlsx';
        }
        else
        {
            $filename = 'Governorates'.time().'.xlsx';
        }
        

        if(isset($_GET['ids'])){
            $ids = $_GET['ids'];
            Excel::store(new GovernoratesCitiesExport($ids , $_GET['is_city']),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new GovernoratesCitiesExport(null , $_GET['is_city'])),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }
    
    public function add_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city_id' => 'required|integer',
            'city_name'=>'required',
            'lang_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('governorates_cities#lang')->withErrors($validator)->withInput();
        }
        Helper::add_localization('geo_cities', 'name', $request->city_id, $request->city_name, $request->lang_id);
        return redirect()->route('governorates_cities')->with('success','تم الإضافة بنجاح');
    }

    public function government_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'government_localization_id' => 'required|integer',
            'government_localization_name'=>'required',
            'government_localization_lang' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect('governorates_cities#lang1')->withErrors($validator)->withInput();
        }
        Helper::add_localization('geo_governorates', 'name', $request->government_localization_id, $request->government_localization_name, $request->government_localization_lang);
        return redirect()->route('governorates_cities')->with('success','تم الإضافة بنجاح');
    }

}
