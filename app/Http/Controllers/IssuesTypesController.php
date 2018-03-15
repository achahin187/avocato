<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cases_Types;
use Validator;
use Excel;

class IssuesTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['issues'] = Cases_Types::all();
        return view('issues_types',$data);
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
        $typesArray[]=['رقم','نوع القضيه'];
        if(isset($_GET['ids'])){
           $ids = $_GET['ids'];
           foreach($ids as $id)
           {
            $typesArray[] = collect(Cases_Types::find($id,['id','name']))->toArray();
        }    
    }
        else{
            $types = Cases_Types::all('id','name');
            foreach($types as $type){
              $typesArray[] = collect($type)->toArray(); 
          }   
      }

        $myFile=Excel::create('أنواع القضايا', function($excel) use($typesArray) {
                    // Set the title
            $excel->setTitle('أنواع القضايا');

                    // Chain the setters
            $excel->setCreator('PentaValue')
            ->setCompany('PentaValue');
                    // Call them separately
            $excel->setDescription('بيانات ما تم اختياره من جدول أنواع القضايا');

            $excel->sheet('أنواع القضايا', function($sheet) use($typesArray) {
                $sheet->setRightToLeft(true); 
                $sheet->getStyle( "A1:B1" )->getFont()->setBold( true );
                // $sheet->cell('A1', function($cell) {$cell->setValue('First Name');   });
                // $sheet->cell('B1', function($cell) {$cell->setValue('Last ');   });
                // $sheet->cell('C1', function($cell) {$cell->setValue('Email');   });           
                $sheet->fromArray($typesArray, null, 'A1', false, false);

            });
        });
        $myFile = $myFile->string('xlsx'); ////change xlsx for the format you want, default is xls
        $response =  array(
           'name' => "أنواع القضايا".date('Y_m_d'), //no extention needed
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
            'new_type'=>'required|unique:cases_types,name',
        ]);

        if ($validator->fails()) {
            return redirect('issues_types#popupModal_1')
                        ->withErrors($validator)
                        ->withInput();
        }

        $issue = new Cases_Types;
        $issue->name = $request->new_type;
        $issue->save();
        return redirect()->route('issues_types')->with('success','تم إضافه نوع جديد بنجاح');
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
       $issue=Cases_Types::find($id);
       $issue->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
           {
            Cases_Types::find($id)->delete();
           } 
    }
}
