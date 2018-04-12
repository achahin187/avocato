<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Helper;

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
        return view('records.records')->with('records', Record::all());
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
        // dd($request->all());

        $this->validate($request, [
            'number' => 'required',
            'pen'    => 'required',
            'name'   => 'required',
            'delivery_date' => 'required',
            'delivered_at'  => 'required',
            'session_date'  => 'required',
            'notes'  => 'required'
        ]);
        
        try {
            $record = new Record;
            $record->number = $request->number;
            $record->pen    = $request->pen;
            $record->client_id      = $request->code;
            $record->delivery_date  = date('Y-m-d', strtotime($request->delivery_date));
            $record->delivered_at   = date('Y-m-d', strtotime($request->delivered_at));
            $record->session_date   = date('Y-m-d', strtotime($request->session_date));
            $record->notes  = $request->notes;
            $record->created_by     = Auth::user()->id;
            $record->save();

        } catch (Exception $ex) {
            dd($ex);
            Session::flash('warning', 'حدث خطأ ما! برجاء التحقق من البيانات والمحاولة مرة اخري');
            return redirect()->back()->withInput();
        }
        
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
        $ids = $request->ids;

        // transform $ids into array values then search and delete
        Record::whereIn('id', explode(",", $ids))->delete();
        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Records deleted successfully!'
        ]);
    }
}
