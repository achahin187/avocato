<?php

namespace App\Http\Controllers;

use Session;
use Validator;
use Excel;

use App\Geo_Cities;
use App\Geo_Governorates;
use Illuminate\Http\Request;

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
        return view('governorates_cities')->with('cities', Geo_Cities::all())
                                        ->with('governments', Geo_Governorates::all());
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
            return redirect('/governorates_cities#popupModal_1')
                            ->withErrors($validator)
                            ->withInput();
        }

        // Add values
        Geo_Governorates::create([
            'name' => $request->gov_name
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
            'city_name'      => 'required|unique:geo_cities,name'
        ]);

        // Check validation
        if ($validator->fails()) {
            return redirect('/governorates_cities#popupModal_1')
                            ->withErrors($validator)
                            ->withInput();
        }

        // Add values
        Geo_Cities::create([
            'governorate_id' => $request->government_id,
            'name'           => $request->city_name
        ]);

        // redirect back with flash message
        Session::flash('success', 'تم إضافة المدينة بنجاح');
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
    public function destroy($id)
    {
        // Find and delete this record
        Geo_Cities::destroy($id);

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

        // transform $ids into array values then search and delete
        Geo_Cities::whereIn('id', explode(",", $ids))->delete();
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    // export Excel sheets
    public function exportXLS(Request $request)
    {
        $data = array(['المدينة', 'المحافظة']);
        $ids = explode(",", $request->ids);
        // $data = Geo_Cities::whereIn('id', explode(",", $ids))->get();

        foreach($ids as $id) {
            $d =  Geo_Cities::find($id);
            array_push( $data, [$d->name, $d->governorate->name]);
        }

        $myFile = Excel::create('المدن والمحافظات', function($excel) use ($data) {
            $excel->sheet('المدن والمحافظات', function($sheet) use ($data) {
                $sheet->setRightToLeft(true);
                $sheet->getStyle('A1:B1')->getFont()->setBold(true);
                $sheet->fromArray($data, null, 'A1', false, false);
            });
        });

        $myFile = $myFile->string('xlsx');
        $response = array(
            'name' => 'المدن والمحافظات',
            'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile)
        );

        return response()->json($response);
    }
}
