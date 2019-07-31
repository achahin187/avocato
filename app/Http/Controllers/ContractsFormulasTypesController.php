<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Formula_Contract_Types;
use App\Formula_Contracts;
use Illuminate\Support\Facades\File;
use Excel;
use App\Exports\FormulasTypesExport;
use App\Languages;
use Session;
use App\Helpers\Helper;

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
        $data['languages'] = Languages::all();
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


    public function sub_excel()
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

    public function main_excel(Request $request)
    {   
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'formulasTypes'.time().'.xlsx';
        if(isset($request->ids)){
           $ids = $request->ids;
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
            'contract_main_type_name'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('contracts_formulas_types#add_main_contract')->withErrors($validator)->withInput();
        }
        
        $main = new Formula_Contract_Types;
        $main->name= $request->contract_main_type_name;
        $main->lang_id = 1;
        $main->save();
        return redirect()->route('contracts_formulas_types')->with('success','تم إضافه تصنيف رئيسي جديد');
    }

    public function store_sub(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_type_id'=>'required|integer',
            'sub_type_name'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('contracts_formulas_types#add_sub_contract')->withErrors($validator)->withInput();
        }

        $sub = new Formula_Contract_Types;
        $sub->name = $request->sub_type_name;
        $sub->parent_id = $request->main_type_id;
        $sub->lang_id = 1;
        $sub->country_id= session('country');
        $sub->save();
        return redirect()->route('contracts_formulas_types')->with('success','تم إضافه تصنيف فرعي جديد');      
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
    public function main_type_destroy($id)
    {
        $main_type = Formula_Contract_Types::find($id);
        Helper::remove_related_localization('formula_contract_types', $id);
        $main_type->children()->delete();
        $main_type->delete();
    }

    public function main_type_destroyAll(Request $request)
    {
        foreach($request->ids as $id)
        {
            $main_type = Formula_Contract_Types::find($id);
            Helper::remove_related_localization('formula_contract_types', $id);
            $main_type->children()->delete();
            $main_type->delete();
        } 
    }
    
    public function sub_type_destroy($id)
    {
        $sub_type = Formula_Contract_Types::find($id);
        Helper::remove_related_localization('formula_contract_types', $id);
        $sub_type->delete();
        // $counter = Formula_Contract_Types::where('parent_id',$sub->parent_id)->get()->count();
        // if($counter == 1)
        // {
        //     $sub->delete();
        //     Formula_Contract_Types::where('id',$sub->parent_id)->delete();
        //     $formulas = Formula_Contracts::where('formula_contract_types_id',$id)->get();
        //     foreach($formulas as $formula){
        //         File::delete($formula->file);
        //         $formula->delete();
        //     }
        // }
        // else{
        //     $sub->delete();
        //     $formulas = Formula_Contracts::where('formula_contract_types_id',$id)->get();
        //     foreach($formulas as $formula){
        //         File::delete($formula->file);
        //         $formula->delete();
        //     }
        // }
    }

    public function sub_type_destroyAll(Request $request)
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            $sub=Formula_Contract_Types::find($id);
            Helper::remove_related_localization('formula_contract_types', $id);
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

    public function main_type_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_type_localization_id' => 'required|integer',
            'main_type_localization_name'=>'required',
            'main_type_localization_lang' => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            return redirect('contracts_formulas_types#main_type_localization')->withErrors($validator)->withInput();
        }
        Helper::add_localization('formula_contract_types', 'name', $request->main_type_localization_id, $request->main_type_localization_name, $request->main_type_localization_lang);
        return redirect()->route('contracts_formulas_types')->with('success','تم الإضافة بنجاح');
    }
    
    public function sub_type_localization(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sub_type_localization_id' => 'required|integer',
            'sub_type_localization_name'=>'required',
            'sub_type_localization_lang' => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            return redirect('contracts_formulas_types#sub_type_localization')->withErrors($validator)->withInput();
        }
        Helper::add_localization('formula_contract_types', 'name', $request->sub_type_localization_id, $request->sub_type_localization_name, $request->sub_type_localization_lang);
        return redirect()->route('contracts_formulas_types')->with('success','تم الإضافة بنجاح');
    }


    public function rename_files()
    {
        $all = Formula_Contracts::all();
        foreach($all as $key => $con_for)
        {
            $extension = substr($con_for->file, strpos($con_for->file, ".") + 1);
            // dd($extension);
            $file = $con_for->file;

            $destinationPath = 'contracts';
            $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999).'.'.$extension;
            try{
                rename(public_path($con_for->file), public_path($fileNameToStore));
                $all[$key]['file'] = $fileNameToStore;
            }
            catch(\exception $extension)
            {
                $all[$key]['file'] = $file;
            }
            
            // $all[$key]->update([
            //     'file' => $fileNameToStore
            // ]);
            
            $all[$key]['extension'] = '.'.$extension;
            $all[$key]->save();
            // Storage::move('hodor/file1.jpg', 'holdthedoor/file2.jpg');

        }
        
    }

}
