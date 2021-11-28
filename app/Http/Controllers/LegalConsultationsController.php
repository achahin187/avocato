<?php

namespace App\Http\Controllers;

use Excel;
use Session;
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
use App\Exports\ConsultationsExport;
use App\Notifications;
use App\Notification_Types;
use App\Notification_Items;
use App\Notifications_Push;
use App\Http\Controllers\NotificationsController;
use App\Languages;

class LegalConsultationsController extends Controller
{

    protected $notification_fcm;

    public function __construct()
    {
        $this->notification_fcm = new NotificationsController();
    }


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
        $consultation_types = Consultation_Types::all();
        $consultations = Consultation::where('country_id',session('country'))->orderBy('created_at', 'desc')->paginate(10);
        foreach ($consultations as $consultation) {
            $consultation_type = Consultation_types::find($consultation->consultation_type_id);
            if ($consultation_type) {
                $consultation['consultation_type'] = $consultation_type->name;
            } else {
                $consultation['consultation_type'] = 'لا يوجد تصنيف';
            }
        }
        $languages = Languages::all();
        return view('legal_consultations.legal_consultations')->with('consultations', $consultations)->with('consultation_types', $consultation_types)->with('languages', $languages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        $data['languages'] = Languages::all();
        $consultation_types = Consultation_Types::all();
        return view('legal_consultations.legal_consultation_add',$data)->with('consultation_types', $consultation_types);
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
            'consultation_type' => 'required',
            'consultation_question' => 'required',
            'consultation_answer' => 'required',
            'consultation_cat' => 'required',
            'language' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $consultation_types = Consultation_Types::all();
        $consultation = new Consultation();

        if (\Auth::check()) {
            $user = Users::where('api_token', $request->input('_token'))->first();
            $consultation_type = Consultation_Types::where('name', $request->input('consultation_cat'))->first();
            $input = [];
            $input['code'] = Helper::generateRandom(new Consultation(), 'code', 6);
            $input['consultation_type_id'] = $consultation_type->id;
            $input['is_paid'] = $request->input('consultation_type');
            $input['question'] = $request->input('consultation_question');
            $input['created_by'] = \Auth::user()->id;
            $input['created_at'] = Carbon::now()->format('Y-m-d H:i:s');
            $input['is_replied'] = 1;
            $input['country_id']=session('country');
            $input['lang_id'] = $request->language;
            $consultation = Consultation::Create($input);

            $consultation->consultation_reply()->create([

                'lawyer_id' => \Auth::user()->id,
                'reply' => $request->input('consultation_answer'),
                'is_perfect_answer' => 1
            ]);

        }
        Helper::add_log(3, 13, $consultation->id);
        return redirect()->route('legal_consultations')->with('consultation_types', $consultation_types)->with('success', 'تم إضافه استشاره جديده بنجاح');

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
        $data['languages'] = Languages::all();
        $consultation_types = Consultation_Types::all();
        $consultation = Consultation::find($id);

        if( $consultation == NULL ) {
            Session::flash('warning', 'الاستشارة القانونية غير موجودة');
            return redirect('/legal_consultations');
        } 

        return view('legal_consultations.legal_consultation_edit',$data)->with('id', $id)->with('consultation_types', $consultation_types)->with('consultation', $consultation);
    }
    public function category($id)
    {
        $data['languages'] = Languages::all();
        $consultation_types = Consultation_Types::all();
        $consultation = Consultation::find($id);

        if( $consultation == NULL ) {
            Session::flash('warning', 'الاستشارة القانونية غير موجودة');
            return redirect('/legal_consultations');
        } 

        return view('legal_consultations.legal_consultation_category',$data)->with('id', $id)->with('consultation_types', $consultation_types)->with('consultation', $consultation);
    }

    public function assign($id)
    {
        $consultation = Consultation::find($id);
        if($consultation->direct_assigned == 1)
        {
            session('error','لا يمكن اضافه رد لهذه الاستشاره لانها موجهه لمحامى');
            return redirect()->back();
        }
        $lawyers = Users::where('country_id',session('country'))->whereHas('rules', function ($query) {
            $query->where('rule_id', '5');
        })->with(['user_detail' => function ($q) {
            $q->orderby('join_date', 'desc');
        }])->get();
 
        foreach ($lawyers as $detail) {
           
           $consultation_lawyers =Consultation_Lawyers::where('lawyer_id', $detail->id)->where('consultation_id', $id)->first();
            
           if ( $consultation_lawyers !== null && $consultation_lawyers->count() > 0) {

                $detail['assigned'] = 1;
            } else {
                $detail['assigned'] = 0;
            }
            if ( $detail->user_detail != null && $detail->user_detail->count() > 0 ) {
                $value = Helper::localizations('geo_countires', 'nationality', $detail->user_detail->nationality_id);

                $detail['nationality'] = $value;
            } else {
                $detail['nationality'] = '';
            }
        }

        return view('legal_consultations.legal_consultation_assign', compact('lawyers', 'consultation'));
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
        Helper::add_log(5, 13, $id);
        $consultation_types = Consultation_Types::all();
        $consultation = Consultation::destroy($id);
        Consultation_Replies::where('consultation_id', $id)->delete();
        Consultation_Lawyers::where('consultation_id', $id)->delete();

        return redirect()->route('legal_consultations')->with('consultation_types', $consultation_types);
    }

    public function destroy_all()
    {
        $consultation_types = Consultation_Types::all();
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            Helper::add_log(5, 13, $id);
            Consultation::destroy($id);
            Consultation_Replies::where('consultation_id', $id)->delete();
            Consultation_Lawyers::where('consultation_id', $id)->delete();

        }
        return redirect()->route('legal_consultations')->with('consultation_types', $consultation_types);
    }

    public function view($id)
    {
        $consultation = Consultation::where('id', $id)->with('consultation_reply')->with('lawyers')->with('client')->first();
        // dd($consultation);
        if( $consultation == NULL ) {
            Session::flash('warning', 'الاستشارة القانونية غير موجودة');
            return redirect('/legal_consultations');
        } 

        foreach ($consultation->consultation_reply as $lawyer) {
            $user = Users::find($lawyer->lawyer_id);
            if ($user) {
                $lawyer['lawyer_name'] = $user->name;
            }

        }
        return view('legal_consultations.legal_consultation_view')->with('consultation', $consultation);
    }

    public function edit_lawyer_response(Request $request)
    {
        $consultation = Consultation_Replies::find($request->input('id'));
        $consultation->Update([
            'reply' => $request->input('reply'),
            'reviewed_by' => \Auth::user()->id,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return response()->json($consultation);
    }

    public function delete_lawyer_response(Request $request)
    {
        // dd($request->input('id'));
        $consultation = Consultation_Replies::destroy($request->input('id'));


        return response()->json($consultation);
    }
    public function edit_consultation(Request $request, $id)
    {
        $consultation = Consultation::find($id);
        if($consultation->direct_assigned == 1)
        {
            session('error','لا يمكن اضافه رد لهذه الاستشاره لانها موجهه لمحامى');
            return redirect()->back();
        }
        $validator = Validator::make($request->all(), [
            //  'consultation_type' => 'required',
            'consultation_question' => 'required',
            'consultation_answer' => 'required',
            //  'consultation_cat' => 'required',
            // 'language' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $consultation_types = Consultation_Types::all();
        
        // $consultation_type = Consultation_Types::where('name', $request->input('consultation_cat'))->first();
        $consultation->Update([
            //  'consultation_type_id' => $request->consultation_cat,
            //  'is_paid' => $request->input('consultation_type'),
                'question' => $request->input('consultation_question'),
                'is_replied'=>1,
       //      'lang_id'=> $request->language,
        ]);
        $consultation_reply = Consultation_Replies::where('consultation_id', $id)->where('lawyer_id',\Auth::user()->id)->update([
            'reply' => $request->input('consultation_answer')
        ]);
        if (!$consultation_reply) {
            $consultation->consultation_reply()->create([

                'lawyer_id' => \Auth::user()->id,
                'reply' => $request->input('consultation_answer'),
                'is_perfect_answer' => 1
            ]);
            $consultation->update(['is_replied' => 1]);
            
           

        }
        $user = Users::find($consultation->created_by);
        $admin = Users::find(\Auth::user()->id);
        // dd($admin);
        $notification_type = Notification_Types::find(14);
        $notification = Notifications::create([
            "msg" => $notification_type->msg,
            "entity_id" => 13,
            "item_id" => $consultation->id,
            "item_name"=>$admin->full_name,
            "item_user_id"=>\Auth::user()->id,
            "user_id" => $consultation->created_by,
            "notification_type_id" => 14,
            "is_read" => 0,
            "is_sent" => 0,
            "is_push"=>1,
            "created_at" => Carbon::now()->format('Y-m-d H:i:s'),
            'action' => 'consultation',
        ]);
         Notifications_Push::create([
            "notification_id" => $notification->id,
            "device_token" => $user->device_token,
            "mobile_os" => $user->mobile_os,
            "lang_id" => $user->lang_id,
            "user_id" => $consultation->created_by
        ]);
        $registrationIds = array($notification->device_token);

         return (new NotificationsController())->pushAndroid($registrationIds,$notification_type->msg);

        Helper::add_log(4, 13, $consultation->id);
        session::flash('message','تم تعديل الرد بنجاح');

        return redirect()->route('legal_consultation_view',$id);
    }
    public function category_consultation(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'consultation_type' => 'required',
           
            'consultation_cat' => 'required',
          //  'language' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $consultation_types = Consultation_Types::all();
        $consultation = Consultation::find($id);
        // dd($request->all());
        $consultation_type = Consultation_Types::where('name', $request->input('consultation_cat'))->first();
        $consultation->Update([
            'consultation_type_id' => $consultation_type->id,
            'is_paid' => $request->input('consultation_type'),
           
            // 'lang_id'=> $request->language,
        ]);
        
        Helper::add_log(4, 13, $consultation->id);
        return redirect()->route('legal_consultations')->with('consultation_types', $consultation_types);
    }
    public function send_consultation_to_all_lawyers($consultation_id)
    {
        //  dd($consultation_id);
        $consultation_types = Consultation_Types::all();
        $consultation = Consultation::find($consultation_id);
        // dd($consultation);
        if($consultation->direct_assigned == 1)
        {
            session('error','لا يمكن تحديد محامين لهذه الاستشاره لانها موجهه لمحامى');
            return redirect()->back();
        }
        $ids = $_POST['ids'];
        $sync_data = [];
        $notification_type = Notification_Types::find(9);
        foreach ($ids as $id) {
            $user=Users::find($consultation->created_by);
            $sync_data[$id] = ['assigned_by' => \Auth::user()->id, 'assigned_at' => Carbon::now()->format('Y-m-d H:i:s')];
            $client=Users::find($consultation->created_by);
            $user = Users::find($id);
            $notification = Notifications::create([
                "msg" => $notification_type->msg,
                "entity_id" => 13,
                "item_id" => $consultation_id,
                "item_name" => $client->full_name,
                "item_user_id"=>$client->id,
                "user_id" => $id,
                "notification_type_id" => 9,
                "is_read" => 0,
                "is_sent" => 0,
                "is_push"=>1,
                "created_at" => Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $notification_push = Notifications_Push::create([
                "notification_id" => $notification->id,
                "device_token" => $user->device_token,
                "mobile_os" => $user->mobile_os,
                "lang_id" => $user->lang_id,
                "user_id" => $id
            ]);

            // $consultation->lawyers()->attach([($id,\Auth::user()->id,Carbon::now()->format('Y-m-d H:i:s') )]);
        }
        $consultation->lawyers()->sync($sync_data);
       
        return redirect()->route('legal_consultations')->with('consultation_types', $consultation_types);
    }


    public function set_perfect_response(Request $request)
    {
        $consultation = Consultation::where('id', $request->input('consultation_id'))->with('consultation_reply')->first();
        // dd($consultation->toArray());
        $consultation->update(['is_replied' => 1]);
        foreach ($consultation->consultation_reply as $value) {

            if ($value->id == $request->input('perfect_answer')) {
                $value->update(['is_perfect_answer' => 1]);
                $user = Users::find($consultation->created_by);
                $notification_type = Notification_Types::find(14);
                $notification = Notifications::create([
                    "msg" => $notification_type->msg,
                    "entity_id" => 13,
                    "item_id" => $consultation->id,
                    "item_name"=>\Auth::user()->full_name,
                    "item_user_id"=>\Auth::user()->id,
                    "user_id" => $consultation->created_by,
                    "notification_type_id" => 14,
                    "is_read" => 0,
                    "is_sent" => 0,
                    "is_push"=>1,
                    "created_at" => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $notification_push = Notifications_Push::create([
                    "notification_id" => $notification->id,
                    "device_token" => $user->device_token,
                    "mobile_os" => $user->mobile_os,
                    "lang_id" => $user->lang_id,
                    "user_id" => $consultation->created_by
                ]);

                $registrationIds = array($notification->device_token);

              return  $this->notification_fcm->pushAndroid($registrationIds,$notification_type->msg);

            } else {
                $value->update(['is_perfect_answer' => 0]);
            }
        }
        return response()->json($consultation);
    }

    public function consultations_filter(Request $request)
    {
        /* date_to make H:i:s = 23:59:59 to avoid two problems
            one : when select same date
            second : when juse select date_to
            Session::flash to send ids of filtered data and extract excel of filtered data
            no all items in the table
         */
        $consultation_types = Consultation_Types::all();
        $consultation_types_ids = [];
        $i = 0;
        foreach ($consultation_types as $key => $value) {

            $consultation_types_ids[$i] = $value['id'];
            $i++;
        }
           
// dd($consultation_types_ids);
             // dd($request->all());
        $data['consultations'] = Consultation::where('country_id',session('country'))->where(function ($q) use ($request, $consultation_types_ids) {
            $date_from = date('Y-m-d H:i:s', strtotime($request->consultation_date_from));
            $date_to = date('Y-m-d H:i:s', strtotime($request->consultation_date_to));

            if ($request->filled('consultation_cat') && count($request->consultation_cat) == 1) {
  //dd($request->consultation_cat[0]);
                $q->where('consultation_type_id', $request->consultation_cat[0]);
            } elseif ($request->filled('consultation_cat') && count($request->consultation_cat) > 1) {
                $q->whereIn('consultation_type_id', $request->consultation_cat);
            } else {
                $q->whereIn('consultation_type_id', $consultation_types_ids);
            }
            if ($request->filled('consultation_type')) {
                // dd($request->consultation_type);
                $q->whereIn('is_paid', $request->consultation_type);
            } else {
                $q->whereIn('is_paid', [0, 1]);
            }
            if ($request->filled('is_replied')) {
                if ($request->is_replied == 1 || $request->is_replied == 0) {
                    $q->where('is_replied', $request->is_replied);
                } else {

                    $q->whereIn('is_replied', [0, 1]);
                // dd($q);
                }
            } else {

                $q->whereIn('is_replied', [0, 1]);
                // dd($q);
            }

            if ($request->filled('consultation_date_from') && $request->filled('consultation_date_to')) {
                // dd($request);
                $q->whereBetween('created_at', array($date_from, $date_to));
            } elseif ($request->filled('consultation_date_from') && !$request->filled('consultation_date_to')) {
                $q->where('created_at', '>=', $date_from);
            } elseif ($request->filled('consultation_date_to') && !$request->filled('consultation_date_from')) {
                $q->where('created_at', '<=', $date_to);
            }

        if ($request->filled('language')) {
            $q->where('lang_id', '=', $request->language);
               }


        })->paginate(10);
        foreach ($data['consultations'] as $consultation) {

            $consultation_type = Consultation_types::find($consultation->consultation_type_id);
               // dd($consultation);
            if ($consultation_type) {
                $consultation['consultation_type'] = $consultation_type->name;
            } else {
                $consultation['consultation_type'] = 'لا يوجد تصنيف';
            }


        }
        // dd($data);
         $languages = Languages::all();
        return view('legal_consultations.legal_consultations')->with('consultations', $data['consultations'])->with('consultation_types', $consultation_types)->with('languages', $languages);

    }
    function lawyers_filter(Request $request, $id)
    {
        $consultation = Consultation::find($id);
        $lawyers = Users::where('country_id',session('country'))->whereHas('rules', function ($query) {

            $query->where('rule_id', '5');
        })->where(function ($query) use ($request) {

            if ($request->filled('lawyer_code')) {

                $query->where('code', $request->lawyer_code);
            }
            if ($request->filled('lawyer_name')) {

                $query->where('name', $request->lawyer_name);
            }
            if ($request->filled('lawyer_tel')) {

                $query->where('mobile', $request->lawyer_tel);
            }

        })->with(['user_detail' => function ($query) use ($request) {

            if ($request->filled('lawyer_level')) {

                $query->where('litigation_level', $request->lawyer_level);
            }
            if ($request->filled('lawyer_national_id')) {

                $query->where('national_id', $request->lawyer_national_id);
            }
            if ($request->filled('start_date')) {

                $query->where('join_date', date('Y-m-d H:i:s', strtotime($request->start_date)));
            }
            if ($request->filled('lawyer_work_sector')) {

                $query->where('work_sector', $request->lawyer_work_sector);
            }


            $query->orderby('join_date', 'desc');
        }])->get();
          // dd($lawyers);
        foreach ($lawyers as $detail) {
            if (count(Consultation_Lawyers::where('lawyer_id', $detail->id)->where('consultation_id', $id)->first())) {

                $detail['assigned'] = 1;
            } else {
                $detail['assigned'] = 0;
            }
            if (count($detail->user_detail) != 0) {
                    // dd($detail->user_detail->nationality_id);
                $value = Helper::localizations('geo_countires', 'nationality', $detail->user_detail->nationality_id);
              // dd($value);
                $detail['nationality'] = $value;
            } else {
                $detail['nationality'] = '';
            }

        }

        return view('legal_consultations.legal_consultation_assign', compact('lawyers', 'consultation'));
    }

    public function excel()
    {
        $filepath = 'public/excel/';
        $PathForJson = 'storage/excel/';
        $filename = 'consultations' . time() . '.xlsx';
        if (isset($_GET['ids'])) {
            $ids = $_GET['ids'];
            Excel::store(new ConsultationsExport($ids), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } elseif ($_GET['filters'] != '') {
            $filters = json_decode($_GET['filters']);
            Excel::store((new ConsultationsExport($filters)), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        } else {
            Excel::store((new ConsultationsExport()), $filepath . $filename);
            return response()->json($PathForJson . $filename);
        }
    }
}
