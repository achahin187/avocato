<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Formula_Contracts;
use App\Formula_Contract_Types;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


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

        public function excel()
    {   
        $courtsArray[]=['رقم','اسم العقد','التصنيف','المحافظه'];
        if(isset($_GET['ids'])){
           $ids = $_GET['ids'];
           foreach($ids as $id)
           {
            $court = Courts::find($id,['id','name','city_id']);
            $courtsArray[] = array(
                'id' => $court->id ,
                'name' => $court->name ,
                'city' => $court->city->name,
                'governorate' => $court->city->governorate->name
                                        );
        }    
    }
        else{
            $courts = Courts::all('id','name','city_id');
            foreach($courts as $court){
              $courtsArray[] = array(
                'id' => $court->id ,
                'name' => $court->name ,
                'city' => $court->city->name,
                'governorate' => $court->city->governorate->name
                                        );
          }   
      }

        $myFile=Excel::create('المحاكم', function($excel) use($courtsArray) {
                    // Set the title
            $excel->setTitle('المحاكم');

                    // Chain the setters
            $excel->setCreator('PentaValue')
            ->setCompany('PentaValue');
                    // Call them separately
            $excel->setDescription('بيانات ما تم اختياره من جدول أنواع القضايا');

            $excel->sheet('المحاكم', function($sheet) use($courtsArray) {
                $sheet->setRightToLeft(true); 
                $sheet->getStyle( "A1:D1" )->getFont()->setBold( true );
                // $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                // $sheet->cell('B1', function($cell) {$cell->setValue('Last ');   });
                // $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });           
                $sheet->fromArray($courtsArray, null, 'A1', false, false);

            });
        });
        $myFile = $myFile->string('xlsx'); ////change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "المحاكم".date('Y_m_d'), //no extention needed
           'file' => "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,".base64_encode($myFile) //mime type of used format
                        );
        return response()->json($response);
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
            'file'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('formulas_create')
            ->withErrors($validator)
            ->withInput();
        }
        $formula = new Formula_Contracts;
        $formula->name= $request->contract_name;
        $formula->formula_contract_types_id = $request->subs;
        if($request->hasFile('file')){
            $fileNameToStore=$request->contract_name.time().rand(111,999).'.'.Input::file('file')->getClientOriginalExtension();
            $destinationPath='contracts';
            // dd($fileNameToStore);
            Input::file('file')->move($destinationPath,$fileNameToStore);
        }
        $formula->file= $fileNameToStore;
        $formula->save();
        return redirect()->route('formulas_create')->with('success','تم إضافه عقد جديد');

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
        ]);

        if ($validator->fails()) {
            return redirect('formulas_create')
            ->withErrors($validator)
            ->withInput();
        }
        $formula = Formula_Contracts::find($id);
        $formula->name= $request->contract_name;
        $formula->formula_contract_types_id = $request->subs;
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
        return redirect()->route('formulas')->with('success','تم تعديل بيانات العقد بنجاح');

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
