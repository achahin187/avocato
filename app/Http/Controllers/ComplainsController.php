<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use Session;
use Excel;
use VodafoneSMS;

use App\Exports\ComplainsExport;
use App\Users;
use App\Feedback;
use App\FeedbackReply;

use Illuminate\Http\Request;
use App\Notifications;
use App\Notification_Types;
use App\Notification_Items;
use App\Notifications_Push;
use Carbon\Carbon;


class ComplainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complains = Feedback::whereHas('user', function($query) {
        $query->where('country_id' ,Auth::user()->country_id);
    })->get();

      // dd($complains);
        return view('clients.complains.complains')->with('complains',$complains);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feedback = Feedback::find($id);

        // redirect to home page if user is not found
        if( $feedback == NULL ) {
            Session::flash('warning', 'الشكوي غير موجود');
            return redirect('/complains');
        }

        \Carbon\Carbon::setLocale('ar');
        return view('clients.complains.complains_edit')->with('complain', $feedback);
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
        $this->validate($request, [
            'newReply'  => 'required'
        ]);

        try {
            $feedback       = Feedback::find($id);
            $feedbackReply  = new FeedbackReply;

            // feedback table
            

            // feedback_replies table
            $feedbackReply->feedback_id = $id;
            $feedbackReply->reply = $request->newReply;
            $feedbackReply->created_at = \Carbon\Carbon::now()->toDateTimeString();
            $feedbackReply->created_by = Auth::user()->id;
            $feedbackReply->save();
            $feedback->is_replied = 1;  // is_replied = true
            $feedback->save();
            $to = Helper::getUserDetails($feedback->user_id) ? Helper::getUserDetails($feedback->user_id)->email : ($feedback->email ? $feedback->email : '');
            // dd($to);
            $notification_type=Notification_Types::find(10);
            if($feedback->user_id != 0 && $feedback->user_id != NULL )
            {
                 $user=Users::find($feedback->user_id);
            // dd($user);
            $notification=Notifications::create([
                "msg"=>$notification_type->msg,
                "entity_id"=>15,
                "item_id"=>$id,
                "user_id"=>$feedback->user_id,
                "notification_type_id"=>9,
                'is_push'=>$notification_type->is_push,
                "is_read"=>0,
                "is_sent"=>0,
                "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
            ]);
             $notification_push=Notifications_Push::create([
                "notification_id"=>$notification->id,
                "device_token"=>$user->device_token,
                "mobile_os"=>$user->mobile_os,
                "lang_id"=>$user->lang_id,
                "user_id"=>$id
            ]);
            }
            if($to != '')
            {
                try {
               $mail=Helper::mail($to,$request->newReply); 
                    }
                    catch (\Exception $e) {
                        // $feedbackReply->delete();
                        // dd($e);
    return redirect()->back()->with('message', 'error while sending email to client  '); 
}
            }
            
            
           
        

        } catch ( Exception $ex ) {
            // dd('jpoeifj');
            Session::flash('warning', 'حدث خطأ ما عند الرد علي هذاه الشكوي, برجاء المحاولة مرة اخري');
            return redirect()->back()->withInput();
        }

        Session::flash('تم الرد بنجاح');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FeedbackReply::where('feedback_id', $id)->delete();
        Feedback::find($id)->delete();

        Session::flash('success', 'تم الحذف بنجاح');
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }

    public function destroySelected(Request $request) {
        $ids = $request->ids;

        // transform $ids into array values then search and delete
        FeedbackReply::whereIn('feedback_id', explode(",", $ids))->delete();
        Feedback::whereIn('id', explode(",", $ids))->delete();

        return response()->json([
            'success' => 'complains deleted successfully!'
        ]);
    }

    public function filter(Request $request) 
    {
        // set timedate
        $complains = new Feedback();
        if($request->date_from) {
        $dd_from = Helper::checkDate($request->date_from, 1);
        }
        if($request->date_to) {
        $dd_to   = Helper::checkDate($request->date_to, 2);
        }
        if(isset($request->date_from) && isset($request->date_to))
        {
            $complains = $complains->whereBetween('created_at', [$dd_from, $dd_to]);
        }
        

        if(isset($request->code)) {
            $id = Users::where('code', 'LIKE', '%'.$request->code.'%')->pluck('id');
            if($id != null)
            $complains = $complains->where('user_id', $id);
        }

        if($request->name) {
            $ids = Users::where('full_name', 'LIKE', '%'.$request->name.'%')->pluck('id');
            $complains = $complains->whereIn('user_id', $ids);
        }

        if($request->activate) {
            if($request->activate == 1) {
                $complains = $complains->get();
            } else if($request->activate == 2) {
                $complains = $complains->where('is_replied', 1)->get();
            } else {
                $complains = $complains->where('is_replied', 0)->get();
            }
        }

        return view('clients.complains.complains')->with('complains', $complains);  
    }

    /**
     * Export excell sheets from DB records
     * @param   $request    holds incoming request including records ids
     */
    public function exportXLS( Request $request ) {
        $filepath ='public/excel/';
        $PathForJson='storage/excel/';
        $filename = 'Complains_'.time().'.xlsx';

        if( isset( $request->ids ) && $request->ids != NULL ){
            $ids = explode(",", $request->ids);

            Excel::store(new ComplainsExport($ids),$filepath.$filename);
            return response()->json($PathForJson.$filename);
        } else{
            Excel::store((new ComplainsExport()),$filepath.$filename);
            return response()->json($PathForJson.$filename); 
        }

        return response()->json($response);
    }
}
