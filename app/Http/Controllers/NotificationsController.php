<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package_Types;
use App\Notifications;
use App\Notification_Items;
use App\Notifications_Push;
use App\Notification_Schedules;
use App\Subscriptions;
use Validator;
use App\User;
use Carbon\Carbon;
use DB;
use App\Users;
use App\Bouquet;
use App\UserBouquet;
class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {   
        
        $data['subscription_types'] = Bouquet::all();
        $data['notifications'] = Notification_Schedules::all();
        // dd($data['subscription_types']);
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
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'package_type'=>'required',
            'date'=>'required',
            'notification'=>'required',
        ]);
        if ($validator->fails()) {
          return redirect('notifications#add_notification')->withErrors($validator)
          ->withInput();
        }
        $send_date = date('Y-m-d H:i:s',strtotime($request->date));
        $packages = implode(',', $request->package_type);
      
        $notification = new Notification_Schedules;
        $notification->msg = $request->notification;
        $notification->schedule = $send_date;
        $notification->notification_type_id=1;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->packages = $packages;
        $notification->save();
        $schedule_id=$notification->id;
        foreach($request->package_type as $package){
          $subs = Bouquet::where('id',$package)->with('users')->first();
        //   dd($subs->users);
          foreach($subs->users as $user) {
            //   $user = $sub->user;
            
                  $notification = new Notifications;
                  $notification->msg = $request->notification;
                  $notification->schedule = $send_date;
                  $notification->notification_type_id=1;
                  $notification->is_sent = 0;
                  $notification->is_push=1;
                  $notification->user_id = $user->id;
                  $notification->created_at = date('Y-m-d H:i:s');
                  $notification->packages = $packages;
                  $notification->notification_schedule_id=$schedule_id;
                  $notification->save();

                  // Save Notification Item
                $item = new Notification_Items;
                $item->item_id = $package;
                $item->notification_id = $notification->id;
                $item->save();
              }
          }
         // $notification->noti_items()->save($item);
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
    public function notification_lawyer(Request $request,$id) {
        $send_date = date('Y-m-d H:i:s',strtotime($request->noti_date));
        $user = Users::find($id);
        $notification = new Notifications;
        $notification->msg = $request->notific;
        $notification->schedule = $send_date;
        $notification->notification_type_id=8;
        $notification->is_sent=0;
        $notification->user_id=$user->id;
        $notification->is_push=1;
        $notification->save();
        $item = new Notification_Items;
        $item->item_id = $id;
        $notification->noti_items()->save($item);
        
        $notification_push= Notifications_Push::create([
            "notification_id" => $notification->id , 
            "device_token" =>  $user->device_token,
            "mobile_os"=> $user->mobile_os,
            "user_id"=>$id
        ]);
        $request->session()->flash('success', 'Notification Sent Successfully');
        return redirect()->back();
        // return response()->json('تمت الإضافه');
    }

    public function notification_for_lawyers()
    {
        $ids = $_POST['ids'];
        foreach($ids as $id) {
        $user = Users::find($id);
        $send_date = date('Y-m-d H:i:s',strtotime($_POST['noti_date']));
        $notification = new Notifications;
        $notification->msg = $_POST['notific'];
        $notification->schedule = $send_date;
        $notification->notification_type_id=8;
        $notification->is_sent=0;
        $notification->user_id = $id;
        $notification->is_push = 1;
        $notification->save();
            $item = new Notification_Items;
            $item->item_id = $id;
            $notification->noti_items()->save($item);
            
            $notification_push= Notifications_Push::create([
                "notification_id" => $notification->id , 
                "device_token" =>  $user->device_token,
                "mobile_os"=> $user->mobile_os,
                "user_id"=>$id
            ]);

}
        session()->flash('success', 'Notification Sent Successfully');
        return response()->json('تمت الإضافه');
    }

    public function filter(Request $request)
    {
        if($request->package == '-1' && !$request->filled('date_from') && !$request->filled('date_to') ) { 
            return redirect()->route('notifications');  
        }
        $data['subscription_types'] = bouquet::all();
        $data['notifications'] = Notifications::where(function($q) use($request){
        $date_from=date('Y-m-d ',strtotime($request->date_from));
        $date_to=date('Y-m-d ',strtotime($request->date_to));
        $q->where('notification_type_id',1);
        $q->whereHas('noti_items',function($q) use($request){
            $q->where('item_id',$request->package);
        });
        if($request->filled('date_from') && $request->filled('date_to') ) {
            $q->whereBetween('schedule', array($date_from, $date_to));
        }
        elseif($request->filled('date_from'))
        {
            $q->whereDate('schedule','>=',$date_from);
        }
        elseif($request->filled('date_to'))
        {
            $q->whereDate('schedule','<=',$date_to);
        }
        })->get();
        return view('clients.notifications',$data);
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
        Notification_Schedules::destroy($id);
        Notifications::where('notification_schedule_id',$id)->delete();
        return 'success';
    }
    public function notification_cron() {
        $notifications = Notifications::where(function ($query){
            $query->whereIn('notification_type_id',[1,8]);
            $query->where('is_sent',0); 
            $query->whereDate('schedule', '<=', date('Y-m-d'));
        })->get();
        foreach($notifications as $notification) {
            $user = $notification->user;
            if(!empty($notification->user_id) && !empty($user->device_token)) {    
                $push = new Notifications_Push;
                $push->notification_id = $notification->id;
                $push->device_token  = $user->device_token;
                $push->mobile_os = $user->mobile_os;
                $push->lang_id = $user->lang_id;
                $push->user_id = $user->id;
                $push->save();
           }
        $notification->is_sent = 1;
        $notification->save();   
        }
    }
    public function push_notification() {
        $notifications_push = Notifications_Push::whereNotNull('device_token')->get();
        $results = array();
        foreach($notifications_push as $notification_push) {
            $device_token = $notification_push->device_token;
            $notification = $notification_push->notification;
            if($notification != null)
            {
                $array["is_sent"] = 1;
                $registrationIds = array($device_token);
                $message = $notification->msg;
               /*  if($notification_push->mobile_os == 'android') { */
                    $results [] = $this->pushAndroid($registrationIds, $message);
            /*     } else if($notification_push->mobile_os == 'ios') {
                     $results [] = $this->pushIos_pem($device_token,$message,$notification->notification_type_id, $notification->item_id);
                }  */
                if($notification->notification_type_id == 8 ) {
                    $array["created_at"] = Carbon::now();
                }
                $notification->update($array);
                $notification->save();
            }
            $notification_push->delete();
        }
        $notifications_push_browser = Notifications_Push::where('mobile_os','browser')->orwhereNull('mobile_os')->orwhere('mobile_os','')->get();
        foreach($notifications_push_browser as $notification_push) {
            $notification = $notification_push->notification;
            $array["is_sent"] = 1;
            if($notification->notification_type_id == 8 ) {
                $array["created_at"] = Carbon::now();
            }
            $notification->update($array);
            $notification->save();
            $notification_push->delete();
        }
    }

    public function pushAndroid($registrationIds,$message) {
        // prep the bundle
        $url = 'https://fcm.googleapis.com/fcm/send';
        // $url = 'https://android.googleapis.com/gcm/send';
        $msg = array (
              'message' 	=> $message,
              'title'		=> 'This is a title. title',
              'subtitle'	=> 'This is a subtitle. subtitle',
              'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
              'vibrate'	=> 1,
              'sound'		=> 1,
              'largeIcon'	=> 'large_icon',
              'smallIcon'	=> 'small_icon'
          );
          $fields = array
          (
              'registration_ids' 	=> $registrationIds,
              'data'			=> $msg
          );
          $headers = array
          (
              'Authorization: key=' . ENV('ANDROID_API_KEY'),
              'Content-Type: application/json'
          );
          $ch = curl_init();
          curl_setopt( $ch,CURLOPT_URL, $url );
          curl_setopt( $ch,CURLOPT_POST, true );
          curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
          curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
          curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
          curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
          $result = curl_exec($ch );
          curl_close( $ch );
          header('Content-type:application/json;charset=utf-8');
        return $result;
    }




    public function pushFCM($id, $message)
    {
        ini_set('max_execution_time', 0);

        $user = User::where('id', $id)->first();
        if ($user->device_token !== null) {
            $data = [
                "to"=> $user->device_token,
                   "notification" =>
                       [
                           "title" => 'Avocato',
                           "body" => $message,
                           'sound'=> 'true',
                           'icon' => 'logo'
                       ],
               ];
               $dataString = json_encode($data);
         
               $headers = [
                   'Authorization: key=AAAAcpnQ_a8:APA91bESNDVZSNu2kSSpg84n1BrWXVySJZLwEhElDHw1UpNclGc50V7s-kgHeKTZhWaR12LHdXErxF-eik7eF6c87pPB-_j75LEkNEBG4VLdPub1bSJJsLhGz1_f6aCS-etIrx3Y_h6g',
                   'Content-Type: application/json',
               ];
         
               $ch = curl_init();
         
               curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
               curl_setopt($ch, CURLOPT_POST, true);
               curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
         
               $result = curl_exec($ch);

        }
        return $result;

    }






    public function pushIos_pem($deviceToken, $message, $notification_type_id, $item_id) {
        $body['aps'] = array(
            'alert' => $message,
            'badge' => 18,
            'category' => 'profile',
            'sender' => 'Avocatoapp',
            'notification_type' => $notification_type_id,
            'item_id' => $item_id,
            'sound' => 'default'
        );
        //Server stuff
        $passphrase = '';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'SecurePushVersion3.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
        'ssl://gateway.sandbox.push.apple.com:2195', $err,
        $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        // $fp = stream_socket_client(
        // 'ssl://gateway.push.apple.com:2195', $err,
        // $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        
        if (!$fp)
        exit("Failed to connect: $err $errstr" . PHP_EOL);
//        echo 'Connected to APNS' . PHP_EOL;
        $payload = json_encode($body);
        // Build the binary notification
        $pack_hex = $result =  null;
        try {
            $pack_hex = pack('H*', $deviceToken);
        } catch (\Exception $e) { 
//            dd('item_id = '.$item_id.' --- '. $e.' \n');
        }
        if(!empty($pack_hex)) {
            $msg = chr(0) . pack('n', 32) . $pack_hex . pack('n', strlen($payload)) . $payload;
            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
            
//            dd($result.' -----------------  ');
        }
        fclose($fp);
        if (!$result) {
            return $result;
//                echo 'Message not delivered' . PHP_EOL;
        } else {
            return $result;
                echo 'Message successfully delivered' . PHP_EOL;
        }
        
    }
    
    public function change($id)
    {
        $notification = Notifications::find($id);
        $notification->is_read=1;
        $notification->save();
        // return response()->json('done');
    }

}
