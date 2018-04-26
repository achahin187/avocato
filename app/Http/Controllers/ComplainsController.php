<?php

namespace App\Http\Controllers;

use Auth;
use Helper;
use Session;

use App\Users;
use App\Feedback;
use App\FeedbackReply;

use Illuminate\Http\Request;


class ComplainsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.complains.complains')->with('complains', Feedback::all());
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
        \Carbon\Carbon::setLocale('ar');
        return view('clients.complains.complains_edit')->with('complain', Feedback::find($id));
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
            $feedback->is_replied = 1;  // is_replied = true
            $feedback->save();

            // feedback_replies table
            $feedbackReply->feedback_id = $id;
            $feedbackReply->reply = $request->newReply;
            $feedbackReply->created_at = \Carbon\Carbon::now()->toDateTimeString();
            $feedbackReply->created_by = Auth::user()->id;
            $feedbackReply->save();
            
            $to = Helper::getUserDetails($feedback->user_id) ? Helper::getUserDetails($feedback->user_id)->email : ($feedback->email ? $feedback->email : '');
            if($to != '')
            {
               $mail=Helper::mail($to,$request->newReply); 
            }
        

        } catch ( Exception $ex ) {
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
        $dd_from = Helper::checkDate($request->date_from, 1);
        $dd_to   = Helper::checkDate($request->date_to, 2);

        $complains = Feedback::whereBetween('created_at', [$dd_from, $dd_to]);

        if($request->code) {
            $complains = $complains->where('user_id', $request->code);
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
}
