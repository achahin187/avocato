<?php

namespace App\Http\Controllers;

use Storage;
use Helper;
use Excel;
use PDF;
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
        // if(session('country') == null)
        // {
        //     return redirect()->route('choose.country');
        // }
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
    // @param   $request    contains ids of records so that we could get their records
    public function exportXLS(Request $request)
    {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = $request->userType.time().'.xlsx';
        if (isset($_GET['is_report'])) {
        $is_report = 1;
      }else{
        $is_report = null; 
      }
        $userRule = $request->userRule;
        
        if(isset($request->ids)){
            if (isset($_GET['is_report'])) {$ids = $request->ids;
                }else{$ids = explode(",", $request->ids);}
           // $ids = explode(",", $request->ids);

            Excel::store(new ClientsExport($ids, $userRule,$is_report ),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        
            } elseif (isset($_GET['filters']) && $_GET['filters'] != '') {
                $filters = json_decode($_GET['filters']);
                 Excel::store(new ClientsExport($filters, $userRule,$is_report ),$filepath.$filename);
            return response()->json($PathForJson.$filename);

        } else{
            Excel::store((new ClientsExport(null, $userRule,$is_report)),$filepath.$filename);
            
            return response()->json($PathForJson.$filename); 
        }
         
        return response()->json($response);
    }

    // Export records as PDF
    // @param   $request    contains ids of records so that we could get their records
    public function exportPDF(Request $request) {

        if( isset($request->ids) && !empty($request->ids) ) {
            $ids = explode(",", $request->ids);            
            $users = Users::whereIn('id', $ids)->get();
        } else {
            $users = array();
        }

        $fileName = 'pdf/clients-'.time().'.pdf';
        // $pdf = PDF::loadView('pdf.clients', ['users' => $users])->setPaper('a4', 'landscape')->save($fileName);

        // view()->share('usersPDF', $users);
        // $html = view('pdf.clients')->render();
        // PDF::load($html, 'A4', 'landscape')->filename($fileName)->output();

        $pdf = PDF::loadView('pdf.clients', ['usersPDF'=>$users]);
        $pdf->save($fileName);

        return response()->json($fileName);
    }

    // Activate Clients icluding individuals, companies, individuals-companies and mobile users
    public function activate($id) {
        $user = Users::find($id);
        ($user->is_active) ? ($user->is_active = 0) : ($user->is_active = 1);   // toggle activation.
        $user->save();

        return redirect()->back();
    }

}
