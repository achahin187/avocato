<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Geo_Governorates;
use App\Geo_Cities;
use App\Courts;
use Validator;
use Excel;

class CourtsListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['courts'] = Courts::all();
        $data['govs'] = Geo_Governorates::all();
        return view('courts_list',$data);
    }

    public function getCity(Request $request){
        $cities= Geo_Cities::where('governorate_id', $request->id)->pluck('name', 'id');
        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

        public function excel()
    {   
        $courtsArray[]=['رقم','اسم المحكمه','المدينه','المحافظه'];
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'court'=>'required',
            'govs'=>'required',
            'cities'=>'required',
        ]);

        if ($validator->fails()) {
            return redirect('courts_list#popupModal_1')
            ->withErrors($validator)
            ->withInput();
        }
        $court = new Courts;
        $court->name= $request->court;
        $court->city_id = $request->cities;
        $court->save();
        return redirect()->route('courts_list')->with('success','تم إضافه محكمه جديده بنجاح');

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
       $court=Courts::find($id);
       $court->delete();
    }

        public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id)
           {
            Courts::find($id)->delete();
           } 
    }

}
