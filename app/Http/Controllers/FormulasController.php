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


class FormulasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contracts']=Formula_Contracts::all();
        $data['main_contracts']=Formula_Contract_Types::whereNull('parent_id')->get();
        return view('formulas.formulas',$data);
    }

    public function create()
    {   
        $data['main_contracts']=Formula_Contract_Types::whereNull('parent_id')->get();
        return view('formulas.formulas_create',$data);
    }

    public function getSub(Request $request){
        $subs= Formula_Contract_Types::where('parent_id', $request->id)->pluck('name', 'id');
        return $subs;
    } 
    public function getSubs(Request $request){
        $subs= Formula_Contract_Types::whereIn('parent_id',  $request->ids)->pluck('name', 'id');
        return $subs;
    }    

    public function excel()
    {   
        $formulasArray[]=['رقم','اسم العقد أو الصيفه','التصنيف الرئيسي','التصنيف الفرعي','تاريخ الإنشاء'];
        if(isset($_GET['ids'])){
         $ids = $_GET['ids'];
         foreach($ids as $id)
         {
            $formula = Formula_Contracts::find($id,['id','name','formula_contract_types_id','created_at']);
            $formulasArray[] = array(
                'id' => $formula->id ,
                'name' => $formula->name ,
                'main' => $formula->sub->parent->name,
                'sub' => $formula->sub->name,
                'created_at' => $formula->created_at
            );
        }    
    }
    elseif($_GET['filters']!=''){
     $filters = json_decode($_GET['filters']);
     foreach($filters as $filter)
     {
        $formula = Formula_Contracts::find($filter,['id','name','formula_contract_types_id','created_at']);
        $formulasArray[] = array(
            'id' => $formula->id ,
            'name' => $formula->name ,
            'main' => $formula->sub->parent->name,
            'sub' => $formula->sub->name,
            'created_at' => $formula->created_at
        );
    }    
}
else{
    $formulas = Formula_Contracts::all('id','name','formula_contract_types_id','created_at');
    foreach($formulas as $formula){
      $formulasArray[] = array(
        'id' => $formula->id ,
        'name' => $formula->name ,
        'main' => $formula->sub->parent->name,
        'sub' => $formula->sub->name,
        'created_at' => $formula->created_at
    );
  }   
}

$myFile=Excel::create('العقود والصيغ', function($excel) use($formulasArray) {
                    // Set the title
    $excel->setTitle('العقود والصيغ');

                    // Chain the setters
    $excel->setCreator('PentaValue')
    ->setCompany('PentaValue');
                    // Call them separately
    $excel->setDescription('بيانات ما تم اختياره من جدول العقود والصيغ');

    $excel->sheet('المحاكم', function($sheet) use($formulasArray) {
        $sheet->setRightToLeft(true); 
        $sheet->getStyle( "A1:E1" )->getFont()->setBold( true );
                // $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                // $sheet->cell('B1', function($cell) {$cell->setValue('Last ');   });
                // $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });           
        $sheet->fromArray($formulasArray, null, 'A1', false, false);

    });
});
        $myFile = $myFile->string('xlsx'); ////change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "العقود والصيغ".date('Y_m_d'), //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
       );
        return response()->json($response);
    }



    public function filter(Request $request){
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
             */
        $data['contracts'] = Formula_Contracts::where(function($q) use($request){
            $date_from=date('Y-m-d H:i:s',strtotime($request->date_from));
            $date_to=date('Y-m-d 23:59:59',strtotime($request->date_to));
            if($request->filled('date_from') && $request->filled('date_to') )
            {
                $q->whereBetween('created_at', array($date_from, $date_to));
            }
            elseif($request->filled('date_from'))
            {
                $q->where('created_at','>=',$date_from);
            }
            elseif($request->filled('date_to'))
            {
                $q->where('created_at','<=',$date_to);
            }

            if($request->has('subs'))
            {
             $q->whereHas('sub',function($q) use($request){
                $q->whereIn('id',$request->subs);

                $q->whereHas('parent',function($q)use($request){
                    $q->whereIn('id',$request->mains);
                });

            });  
         }
         elseif($request->has('mains'))
         {
             $q->whereHas('sub',function($q) use($request){       
                 $q->whereHas('parent',function($q)use($request){
                    $q->whereIn('id',$request->mains);
                });

             });  
         }


     })->get();
        foreach($data['contracts'] as $contract)
        {
            $filter_ids[]=$contract->id;
        }
        Session::flash('filter_ids',$filter_ids);
        $data['main_contracts']=Formula_Contract_Types::whereNull('parent_id')->get();
        return view('formulas.formulas',$data);
        
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
            'contract_name'=>'required',
            'mains'=>'required',
            'subs'=>'required',
            'is_contract'=>'required',
            'file'=>'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect('formulas_create')
            ->withErrors($validator)
            ->withInput();
        }
        $formula = new Formula_Contracts;
        $formula->name= $request->contract_name;
        $formula->formula_contract_types_id = $request->subs;
        $formula->is_contract=$request->is_contract;
        if($request->hasFile('file')){
            $fileNameToStore=$request->contract_name.time().rand(111,999).'.'.Input::file('file')->getClientOriginalExtension();
            $destinationPath='contracts';
            // dd($fileNameToStore);
            Input::file('file')->move($destinationPath,$fileNameToStore);
        }
        $formula->file= $fileNameToStore;
        $formula->save();
        return redirect()->route('formulas_create')->with('success','تمت الإضافه');

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
        $data['main_contracts']=Formula_Contract_Types::whereNull('parent_id')->get();
        $data['contract']=Formula_Contracts::find($id);
        return view('formulas.formulas_edit',$data);
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
            'contract_name'=>'required',
            'mains'=>'required',
            'subs'=>'required',
            'is_contract'=>'required',
            'file'=>'mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect('formulas_create')
            ->withErrors($validator)
            ->withInput();
        }
        $formula = Formula_Contracts::find($id);
        $formula->name= $request->contract_name;
        $formula->formula_contract_types_id = $request->subs;
        $formula->is_contract=$request->is_contract;
        if($request->hasFile('file')){
            File::delete('contracts/'.$formula->file);
            $fileNameToStore=$request->contract_name.time().rand(111,999).'.'.Input::file('file')->getClientOriginalExtension();
            $destinationPath='contracts';
            Input::file('file')->move($destinationPath,$fileNameToStore);
        }
        else{
            $destinationPath='contracts';
            $fileNameToStore=$request->contract_name.time().rand(111,999).'.'.substr($formula->file, strrpos($formula->file, '.')+1);
            rename(public_path($destinationPath.'/'.$formula->file), public_path($destinationPath.'/'.$fileNameToStore));
        }
        $formula->file= $fileNameToStore;
        $formula->save();
        return redirect()->route('formulas')->with('success','تم تعديل البيانات بنجاح');

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
        File::delete('contracts/'.$formula->file);
        $formula->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            $formula = Formula_Contracts::find($id);
            File::delete('contracts/'.$formula->file);
            $formula->delete();
        } 
    }
}
