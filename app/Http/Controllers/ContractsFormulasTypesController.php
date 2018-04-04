<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Formula_Contract_Types;
use App\Formula_Contracts;
use Excel;

class ContractsFormulasTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $mains=Formula_Contract_Types::where('id',2)->first();
        // return $mains->child;
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
        $contractsArray[]=['رقم','التصنيف الرئيسي','التصنيف الفرعي'];
        if(isset($_GET['ids'])){
         $ids = $_GET['ids'];
         foreach($ids as $id)
         {
            $sub = Formula_Contract_Types::find($id,['id','name','parent_id']);
            $contractsArray[] = array(
                'id' => $sub->id ,
                'main' => $sub->parent->name,
                'sub' => $sub->name ,
            );
        }    
    }
    else{
        $subs = Formula_Contract_Types::whereNotNull('parent_id')->get(['id','name','parent_id']);
        foreach($subs as $sub){
          $contractsArray[] = array(
            'id' => $sub->id ,
            'main' => $sub->parent->name,
            'sub' => $sub->name ,
        );
      }   
  }

  $myFile=Excel::create('أنواع الصيغ والعقود', function($excel) use($contractsArray) {
                    // Set the title
    $excel->setTitle('أنواع الصيغ والعقود');

                    // Chain the setters
    $excel->setCreator('PentaValue')
    ->setCompany('PentaValue');
                    // Call them separately
    $excel->setDescription('بيانات ما تم اختياره من جدول أنواع الصيغ والعقود');

    $excel->sheet('أنواع الصيغ والعقود', function($sheet) use($contractsArray) {
        $sheet->setRightToLeft(true); 
        $sheet->getStyle( "A1:C1" )->getFont()->setBold( true );
                // $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                // $sheet->cell('B1', function($cell) {$cell->setValue('Last ');   });
                // $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });           
        $sheet->fromArray($contractsArray, null, 'A1', false, false);

    });
});
        $myFile = $myFile->string('xlsx'); ////change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "أنواع الصيغ والعقود".date('Y_m_d'), //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
       );
        return response()->json($response);
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
        Formula_Contracts::where('formula_contract_types_id',$id)->delete();
    }
    else{
        $sub->delete();
        Formula_Contracts::where('formula_contract_types_id',$id)->delete();
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
            Formula_Contracts::where('formula_contract_types_id',$id)->delete();
        }
        else{
            $sub->delete();
            Formula_Contracts::where('formula_contract_types_id',$id)->delete();
        }
    } 


    }

}
