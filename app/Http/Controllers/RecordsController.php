<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Helper;
use Excel;

use App\Exports\RecordsExport;
use App\Record;
use App\Users;
use Illuminate\Http\Request;

class RecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('records.records')->with('records', Record::all())
            ->with('pens', Record::all());
    }

    public function filter(Request $request)
    {
        // set timedate
        $dd_from = Helper::checkDate($request->dd_from, 1);
        $dd_to = Helper::checkDate($request->dd_to, 2);

        $sd_from = Helper::checkDate($request->sd_from, 1);
        $sd_to = Helper::checkDate($request->sd_to, 2);

        $da_from = Helper::checkDate($request->da_from, 1);
        $da_to = Helper::checkDate($request->da_to, 2);

        $records = Record::whereBetween('delivery_date', [$dd_from, $dd_to])
            ->whereBetween('session_date', [$sd_from, $sd_to])
            ->whereBetween('delivered_at', [$da_from, $da_to]);

        if ($request->pen) {
            $records->whereIn('pen', $request->pen);
        }

        if ($request->name) {
            $ids = Users::where('full_name', 'LIKE', '%' . $request->name . '%')->pluck('id');
            $records->whereIn('client_id', $ids);
        }

        return view('records.records')->with('records', $records->get())
            ->with('pens', Record::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Helper::getUsersBasedOnRules([7, 8, 9, 10]);     // get users of type: mobile, individual, company and individual-company clients.
        return view('records.records_create', compact(['clients']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'number' => 'required',
            'pen' => 'required',
            'name' => 'required',
            'delivery_date' => 'required|date',
            'delivered_at' => 'required|date',
            'session_date' => 'required|date',
            // 'notes' => 'required'
        ]);

        try {
            $record = new Record;
            $record->number = $request->number;
            $record->pen = $request->pen;
            $record->client_id = $request->code;
            $record->delivery_date = date('Y-m-d', strtotime($request->delivery_date));
            $record->delivered_at = date('Y-m-d', strtotime($request->delivered_at));
            $record->session_date = date('Y-m-d', strtotime($request->session_date));
            if(isset($request->notes)){ $record->notes = $request->notes; }
            $record->created_by = Auth::user()->id;
            $record->save();

        } catch (Exception $ex) {
            Session::flash('warning', 'حدث خطأ ما! برجاء التحقق من البيانات والمحاولة مرة اخري');
            return redirect()->back()->withInput();
        }

        Helper::add_log(3, 20, $record->id);

        // redirect with success
        Session::flash('success', 'تم الاضافة بنجاح');
        return redirect('/records');
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

    public function destroy($id)
    {
        Helper::add_log(5, 20, $id);

        // Find and delete this record
        Record::find($id)->delete();

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
        $ids = explode(",", $request->ids);

        foreach ($ids as $id) {
            Helper::add_log(5, 20, $id);
        }

        // transform $ids into array values then search and delete
        Record::whereIn('id', $ids)->delete();
        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }

    /**
     * Export excell sheets from DB records
     * @param   $request    holds incoming request including records ids
     */
    public function exportXLS(Request $request)
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'Records_' . time() . '.xlsx';

        if (isset($request->ids) && $request->ids != null) {
            $ids = explode(",", $request->ids);

            Excel::store(new RecordsExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new RecordsExport()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }

        return response()->json($response);
    }
}
