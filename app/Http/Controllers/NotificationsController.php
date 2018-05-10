<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package_Types;
use App\Notifications;
use App\Notification_Items;
use App\Notifications_Push;
use App\Subscriptions;
use Validator;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['subscription_types'] = Package_Types::all();
        $data['notifications'] = Notifications::where('notification_type_id',1)->get();
        // $data['notes'] = Notifications::where('notification_type_id','!=',1)->get();
        // foreach($data['notes'] as $note){
        //     if($note->notification_type_id ==2){

        //     $note['url']="route('task_emergency_view',$note->item_id)";
        //     }
        //     if($note->notification_type_id ==4){

        //     $note['url']="route('complains.edit',$note->item_id)";
        //     }
        //     if($note->notification_type_id ==5 and $note->entity_id==11 ){

        //     $note['url']="route('services_show',$note->item_id)";
        //     }
        //     if($note->notification_type_id ==5 and $note->entity_id==14 ){

        //     $note['url']="route('case_view',$note->item_id)";
        //     }
        //     if($note->notification_type_id ==6){

        //     $note['url']="route('lawyers_show',$note->item_id)";
        //     }
        //     if($note->notification_type_id ==7){

        //     $note['url']="route('legal_consultation_view',$note->item_id)";
        //     }
        // }
        return view('clients.notifications',$data);
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
    $validator = Validator::make($request->all(), [
        'package_type'=>'required',
        'date'=>'required',
        'notification'=>'required',
      ]);

      if ($validator->fails()) {
        return redirect('notifications#add_notification')->withErrors($validator)
        ->withInput();
      }
      
//      $send_date = date('Y-m-d H:i:s',strtotime($request->date));
      $send_date = Carbon::now()->timestamp;
      $notification = new Notifications;
      $notification->msg = $request->notification;
      $notification->schedule = $send_date;
      $notification->notification_type_id=1;
      $notification->is_sent=0;
      $notification->created_at = Carbon::now()->timestamp;
      $notification->save();
      
      foreach($request->package_type as $package){
        $item = new Notification_Items;
        $item->item_id = $package;
        $notification->noti_items()->save($item);
      }
        return redirect()->route('notifications')->with('success','تم إضافه تنبيه');
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
        $notification = Notifications::find($id);
        $notification->noti_items()->delete();
        $notification->delete();
    }

    public function notification_cron() {
        $notifications = Notifications::where('notification_type_id',1)->get();
        foreach($notifications as $notification) {
            dd($notification->schedule .' -- '.Carbon::now()->timestamp);
            
            
            if($notification->is_sent == 0 && ($notification->schedule  <= Carbon::now()->timestamp)) {
                
                foreach($notification->noti_items as $item){
                    $subs = Subscriptions::where('package_type_id',$item->item_id)->get();
                    foreach($subs as $sub){
                        $user = $sub->user;
                        $push = new Notifications_Push;
                        $push->notification_id=$notification->id;
                        $push->device_token=$user->device_token;
                        $push->mobile_os=$user->mobile_os;
                        $push->lang_id=$user->lang_id;
                        $push->save();
                    }
                }
                $notification->is_sent = 1;
                $notification->save();
            }
        }
        exit;
    }

        public function change($id)
    {
        $notification = Notifications::find($id);
        $notification->is_read=1;
        $notification->save();
        // return response()->json('done');
    }

}
