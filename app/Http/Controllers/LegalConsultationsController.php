<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Consultation;
use Carbon\Carbon;
use App\Users;
use App\Consultation_Types;
use Illuminate\Support\Facades\Input;

class LegalConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultations=Consultation::all();
        // foreach ($consultations as $consultation) {
           
        //         $consultation_type=Consultation_types::where('id',$consultation->consultation_type_id)->first();
               
        //         $consultations['consultation_type']=$consultation_type->name;
            
        // }
        
        return view('legal_consultations.legal_consultations')->with('consultations',$consultations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('legal_consultations.legal_consultation_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consultation=new Consultation();
         $validator = Validator::make($request->all(),  $consultation::$rules);
         if($validator->fails())
         {
            return  redirect()->route('legal_consultation_add')
                    ->withErrors($validator)
                    ->withInput();
         }
        if(\Auth::check())
            {
         $user=Users::where('api_token',$request->input('_token'))->first();
        $consultation_type=Consultation_Types::where('name',$request->input('consultation_cat'))->first();
        $input=[];
        $input['code']=Helper::generateRandom(new Consultation(),'code',6);
        $input['consultation_type_id']=$consultation_type->id;
        $input['is_paid']=$request->input('consultation_type');
        $input['question']=$request->input('consultation_question');
        $input['created_by']=\Auth::user()->id;
         $input['created_at']=Carbon::now()->format('Y-m-d H:i:s');
         $input['is_replied']=1;
        // dd($input);
        Consultation::Create($input);
                
            }
        // dd(Input::all());
        return  redirect()->route('legal_consultation_add');
       // return redirect()->route('legal_consultation_add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('legal_consultations.legal_consultations_show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('legal_consultations.legal_consultations_edit');
    }

    public function assign()
    {
        return view('legal_consultations.legal_consultations_assign');
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
}
