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
use App\User_Details;
use App\Consultation_Replies;
use App\Consultation_Lawyers;

class LegalConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function get_consultation_catgories()
    // {
    //     return Consultation_Types::all();
    // }
    public function index()
    {
        $consultation_types=Consultation_Types::all();
        $consultations=Consultation::orderBy('created_at','desc')->get();
        foreach ($consultations as $consultation) {
          
                 $consultation_type=Consultation_types::find($consultation->consultation_type_id);
               // dd($consultation);
                 if($consultation_type)
                 {
                    $consultation['consultation_type']=$consultation_type->name;
                 }
                 
            
        }
        
        return view('legal_consultations.legal_consultations')->with('consultations',$consultations)->with('consultation_types',$consultation_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $consultation_types=Consultation_Types::all();
        return view('legal_consultations.legal_consultation_add')->with('consultation_types',$consultation_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consultation_types=Consultation_Types::all();
        $consultation=new Consultation();
        
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
         
        $consultation = Consultation::Create($input);
        
       $consultation-> consultation_reply()->create([
            
            'lawyer_id' => \Auth::user()->id,
            'reply' => $request->input('consultation_answer'),
            'is_perfect_answer' => 1
        ]);
                
            }
        
        return  redirect()->route('legal_consultations')->with('consultation_types',$consultation_types);
       
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
    public function edit($id)
    {
        $consultation_types=Consultation_Types::all();
        return view('legal_consultations.legal_consultation_edit')->with('id',$id)->with('consultation_types',$consultation_types);
    }

    public function assign($id)
    {
        $consultation = Consultation::find($id);
        // dd($consultation);
        $lawyers=Users::whereHas('rules', function ($query) {
        $query->where('rule_id', '5');
        })->with(['user_detail'=>function($q) {
                 $q->orderby('join_date','desc');
                 }])->get();
        foreach($lawyers as $detail){
            if(count(Consultation_Lawyers::where('lawyer_id',$detail->id)->get()))
                {
                    
                    $detail['assigned']=1;
                }
                else
                {
                    $detail['assigned']=0;
                }
                $value=Helper::localizations('geo_countries','nationality',$detail->user_detail->nationality_id);
              
                $detail['nationality']=$value;
                 }
        
        return view('legal_consultations.legal_consultation_assign',compact('lawyers','consultation'));
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
        $consultation_types=Consultation_Types::all();
        $consultation = Consultation::destroy( $id);
        Consultation_Replies::where('consultation_id',$id)->delete();
        return  redirect()->route('legal_consultations')->with('consultation_types',$consultation_types);
    }

     public function destroy_all()
    {
        $consultation_types=Consultation_Types::all();
        $ids = $_POST['ids'];
        foreach($ids as $id)
        {
            Consultation::destroy($id);
            Consultation_Replies::where('consultation_id',$id)->delete();
        } 
        return  redirect()->route('legal_consultations')->with('consultation_types',$consultation_types);
    }

    public function view( $id)
    {
        // dd($id);
        $consultation = Consultation::where('id',$id)->with('consultation_reply')->first();
        foreach($consultation->consultation_reply as $lawyer)
        {
            // dd($lawyer->lawyer_id);
            $user=Users::find($lawyer->lawyer_id);
            if($user)
            {
                // dd($user);
               $lawyer['lawyer_name']=$user->name; 
            }
            
        }
        return view('legal_consultations.legal_consultation_view')->with('consultation',$consultation);
    }

    public function edit_lawyer_response(Request $request)
    {
        // dd($request->input('id'));
        $consultation = Consultation_Replies::find( $request->input('id'));
        $consultation->Update([
            'reply' => $request->input('reply'),
            'reviewed_by' => \Auth::user()->id ,
             'updated_at' =>Carbon::now()->format('Y-m-d H:i:s') 
            ]);
        
     return response()->json($consultation);
    }

    public function delete_lawyer_response(Request $request)
    {
        // dd($request->input('id'));
        $consultation = Consultation_Replies::destroy( $request->input('id'));
        
        
     return response()->json($consultation);
    }
    public function edit_consultation(Request $request ,$id)
    {
         $consultation_types=Consultation_Types::all();
        $consultation = Consultation::find($id);
        // dd($request->all());
        $consultation_type=Consultation_Types::where('name',$request->input('consultation_cat'))->first();
        $consultation->Update([
            'consultation_type_id' => $consultation_type->id,
            'is_paid' => $request->input('consultation_type') ,
             'question' =>$request->input('consultation_question') 
            ]);
        Consultation_Replies::where('consultation_id',$id)->update([
            'reply'=>$request->input('consultation_answer')
        ]);
        return  redirect()->route('legal_consultations')->with('consultation_types',$consultation_types);
    }
     public function send_consultation_to_all_lawyers($consultation_id)
    {
        // dd($consultation_id);
         $consultation_types=Consultation_Types::all();
        $consultation = Consultation::find($consultation_id);
        $ids = $_POST['ids'];
        $sync_data = [];
         foreach($ids as $id)
        {
            $sync_data[$id] = ['assigned_by' => \Auth::user()->id , 'assigned_at' => Carbon::now()->format('Y-m-d H:i:s')];
            // $consultation->lawyers()->attach([($id,\Auth::user()->id,Carbon::now()->format('Y-m-d H:i:s') )]);
        }
        $consultation->lawyers()->sync($sync_data);
        return  redirect()->route('legal_consultations')->with('consultation_types',$consultation_types);
    }


        public function filter(Request $request){
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
             */

            dd($request->all());
             $data['users'] = Users::where(function($q) use($request){
            $date_from=date('Y-m-d H:i:s',strtotime($request->date_from));
            $date_to=date('Y-m-d 23:59:59',strtotime($request->date_to));

            if($request->has('roles'))
            {
               $q->whereHas('rules',function($q) use($request){
                $q->whereIn('name',$request->roles);

            });  
           }
           else{
              $q->whereHas('rules', function($q){
                $q->whereIn('name',['admin','data entry','call center']);
            });  
          }

            if($request->filled('date_from') && $request->filled('date_to') )
            {
                $q->whereBetween('last_login', array($date_from, $date_to));
            }
            elseif($request->filled('date_from'))
            {
                $q->where('last_login','>=',$date_from);
            }
            elseif($request->filled('date_to'))
            {
                $q->where('last_login','<=',$date_to);
            }
            if($request->active == 1 || $request->active == 0 )
            {
                $q->where('is_active',$request->active);
            }



     })->get();
        $data['roles']=Rules::whereBetween('id',array('2','4'))->get();
        foreach($data['users'] as $user)
        {
            $filter_ids[]=$user->id;
        }
        if(!empty($filter_ids))
        {
                    Session::flash('filter_ids',$filter_ids);
        }
        else{
            $filter_ids[]=0;
            Session::flash('filter_ids',$filter_ids);
        }

        return view('users.users_list',$data);
        
    }
}
