<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Formula_Contract_Types;
use App\Formula_Contracts;
use Illuminate\Support\Facades\File;
use Excel;
use App\Exports\FormulasTypesExport;
use Session;

class ContractsFormulasTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subs'] = Formula_Contract_Types::whereNotNull('parent_id')->get();
        $data['main_contracts']=Formula_Contract_Types::whereNull('parent_id')->get();
        return view('contracts_formulas_types',$data);
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
        $filename = 'formulasTypes'.time().'.xlsx';
        if(isset($_GET['ids'])){
           $ids = $_GET['ids'];
            Excel::store(new FormulasTypesExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        }
        else{
        Excel::store((new FormulasTypesExport()),$filepath.$filename);
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
            'main'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('contracts_formulas_types#popupModal_1')
            ->withErrors($validator)
            ->withInput();
        }
        $main = new Formula_Contract_Types;
        $main->name= $request->main;
        $main->save();
        return redirect()->route('contracts_formulas_types')->with('success','تم إضافه تصنيف رئيسي جديد');
    }

    public function store_sub(Request $request)
    {
        $tab="tab";
        switch ($request->input('action')) {
            case 'one':

        $validator = Validator::make($request->all(), [
            'mains'=>'required',
            'sub'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('contracts_formulas_types#popupModal_1')
            ->withErrors($validator)
            ->withInput();
        }
        $sub = new Formula_Contract_Types;
        $sub->name = $request->sub;
        $sub->parent_id = $request->mains;
        $sub->country_id=session('country');
        $sub->save();
        return redirect()->route('contracts_formulas_types')->with('success','تم إضافه تصنيف فرعي جديد');

            break;

            case 'more':

        $validator = Validator::make($request->all(), [
            'mains'=>'required',
            'sub'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('contracts_formulas_types#popupModal_1')
            ->withErrors($validator)
            ->withInput();
        }
        $sub = new Formula_Contract_Types;
        $sub->name = $request->sub;
        $sub->parent_id = $request->mains;
        $sub->country_id=session('country');
        $sub->save();
        return redirect('contracts_formulas_types#popupModal_1')->with( ['tab'=> $tab,'success_more' =>'تم إضافه تصنيف فرعي جديد'] );
            break;
        }
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
        $sub=Formula_Contract_Types::find($id);
        $counter = Formula_Contract_Types::where('parent_id',$sub->parent_id)->get()->count();
        if($counter == 1)
        {
            $sub->delete();
            Formula_Contract_Types::where('id',$sub->parent_id)->delete();
            $formulas = Formula_Contracts::where('formula_contract_types_id',$id)->get();
            foreach($formulas as $formula){
                File::delete($formula->file);
                $formula->delete();
            }
        }
        else{
            $sub->delete();
            $formulas = Formula_Contracts::where('formula_contract_types_id',$id)->get();
            foreach($formulas as $formula){
                File::delete($formula->file);
                $formula->delete();
            }
        }
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            $sub=Formula_Contract_Types::find($id);
            $counter = Formula_Contract_Types::where('parent_id',$sub->parent_id)->get()->count();
            if($counter == 1)
            {
                $sub->delete();
                Formula_Contract_Types::where('id',$sub->parent_id)->delete();
                $formulas = Formula_Contracts::where('formula_contract_types_id',$id)->get();
                foreach($formulas as $formula){
                    File::delete($formula->file);
                    $formula->delete();
                }
            }
            else{
                $sub->delete();
                $formulas = Formula_Contracts::where('formula_contract_types_id',$id)->get();
                foreach($formulas as $formula){
                    File::delete($formula->file);
                    $formula->delete();
                }
            }
        } 
    }
}
