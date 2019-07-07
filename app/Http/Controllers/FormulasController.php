<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Formula_Contracts;
use App\Formula_Contract_Types;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Excel;
use Session;
use App\Exports\FormulasExport;
use Helper;
use Auth;
use App\Languages;



class FormulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contracts'] = Formula_Contracts::where('country_id',session('country'))->get();
        $data['main_contracts'] = Formula_Contract_Types::whereNull('parent_id')->get();
         $data['languages'] = Languages::all();
        return view('formulas.formulas', $data);
    }

    public function create()
    {
        $data['languages'] = Languages::all();
        $data['main_contracts'] = Formula_Contract_Types::whereNull('parent_id')->get();
        return view('formulas.formulas_create', $data);
    }

    public function getSub(Request $request)
    {
        $subs = Formula_Contract_Types::where('parent_id', $request->id)->pluck('name', 'id');
        return $subs;
    }
    public function getSubs(Request $request)
    {
        $subs = Formula_Contract_Types::whereIn('parent_id', $request->ids)->pluck('name', 'id');
        return $subs;
    }

    public function excel()
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'formulas' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];
            Excel::store(new FormulasExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            Excel::store((new FormulasExport($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new FormulasExport()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }

    }



    public function filter(Request $request)
    {
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
         */
        $data['contracts'] = Formula_Contracts::where('country_id',session('country'))->where(function ($q) use ($request) {
            $date_from = date('Y-m-d H:i:s', strtotime($request->date_from));
            $date_to = date('Y-m-d 23:59:59', strtotime($request->date_to));
            if ($request->filled('date_from') && $request->filled('date_to')) {
                $q->whereBetween('created_at', array($date_from, $date_to));
            } elseif ($request->filled('date_from')) {
                $q->where('created_at', '>=', $date_from);
            } elseif ($request->filled('date_to')) {
                $q->where('created_at', '<=', $date_to);
            }

            if ($request->has('subs')) {
                $q->whereHas('sub', function ($q) use ($request) {
                    $q->whereIn('id', $request->subs);

                    $q->whereHas('parent', function ($q) use ($request) {
                        $q->whereIn('id', $request->mains);
                    });

                });
            } elseif ($request->has('mains')) {
                $q->whereHas('sub', function ($q) use ($request) {
                    $q->whereHas('parent', function ($q) use ($request) {
                        $q->whereIn('id', $request->mains);
                    });

                });
            }

        if ($request->filled('language')) {
            $q->where('lang_id', '=', $request->language);
               }
        })->get();
        $data['main_contracts'] = Formula_Contract_Types::whereNull('parent_id')->get();
        foreach ($data['contracts'] as $contract) {
            $filter_ids[] = $contract->id;
        }
        if (!empty($filter_ids)) {
            Session::flash('filter_ids', $filter_ids);
        } else {
            $filter_ids[] = 0;
            Session::flash('filter_ids', $filter_ids);
        }
         $data['languages'] = Languages::all();
        return view('formulas.formulas', $data);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'contract_name' => 'required',
            'mains' => 'required',
            'subs' => 'required',
            'is_contract' => 'required',
            'file' => 'required|mimes:pdf',
            'language' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('formulas_create')
                ->withErrors($validator)
                ->withInput();
        }
        $formula = new Formula_Contracts;
        $formula->name = $request->contract_name;
        $formula->formula_contract_types_id = $request->subs;
        $formula->is_contract = $request->is_contract;
        if ($request->hasFile('file')) {
            $destinationPath = 'contracts';
            $con_name = str_replace(" ","_",$request->contract_name)."_";
            $fileNameToStore = $destinationPath . '/' . $con_name . time() . rand(111, 999) . '.' . Input::file('file')->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('file')->move($destinationPath, $fileNameToStore);
        }
        $formula->file = $fileNameToStore;
        $formula->country_id=session('country');
        $formula->lang_id = $request->language;
        $formula->save();
        Helper::add_log(3, 17, $formula->id);
        return redirect()->route('formulas_create')->with('success', 'تمت الإضافه');

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
        $data['languages'] = Languages::all();
        $data['main_contracts'] = Formula_Contract_Types::whereNull('parent_id')->get();
        $data['contract'] = Formula_Contracts::find($id);

        if( $data['contract'] == NULL ) {
            Session::flash('warning', 'العقد او الصيغة غير موجود');
            return redirect('/formulas');
        } 

        return view('formulas.formulas_edit', $data);
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
        $validator = Validator::make($request->all(), [
            'contract_name' => 'required',
            'mains' => 'required',
            'subs' => 'required',
            'is_contract' => 'required',
            'file' => 'mimes:pdf',
            //'language' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('formulas_create')
                ->withErrors($validator)
                ->withInput();
        }
        $formula = Formula_Contracts::find($id);
        $formula->name = $request->contract_name;
        $formula->formula_contract_types_id = $request->subs;
        $formula->is_contract = $request->is_contract;
        if ($request->hasFile('file')) {
            $destinationPath = 'contracts';
            File::delete($formula->file);
            $fileNameToStore = $destinationPath . '/' . $request->contract_name . time() . rand(111, 999) . '.' . Input::file('file')->getClientOriginalExtension();
            $destinationPath = 'contracts';
            Input::file('file')->move($destinationPath, $fileNameToStore);
        } else {
            $destinationPath = 'contracts';
            $fileNameToStore = $destinationPath . '/' . $request->contract_name . time() . rand(111, 999) . '.' . substr($formula->file, strrpos($formula->file, '.') + 1);
            rename(public_path($formula->file), public_path($fileNameToStore));
        }
        $formula->file = $fileNameToStore;
        $formula->country_id=session('country');
       // $formula->lang_id = $request->language;
        $formula->save();
        Helper::add_log(4, 17, $formula->id);
        return redirect()->route('formulas')->with('success', 'تم تعديل البيانات بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formula = Formula_Contracts::find($id);
        Helper::add_log(5, 17, $formula->id);
        File::delete($formula->file);
        $formula->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $formula = Formula_Contracts::find($id);
            Helper::add_log(5, 17, $formula->id);
            File::delete($formula->file);
            $formula->delete();
        }
    }
}
