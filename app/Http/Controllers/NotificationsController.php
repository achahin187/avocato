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
use Carbon\Carbon;
use DB;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {   
        // if(session('country') == null)
        // {
        //     return redirect()->route('choose.country');
        // }
        $data['subscription_types'] = Package_Types::all();
        $data['notifications'] = Notification_Schedules::all();
       
//        $data['notifications'] = Notifications::whereIn('notification_type_id',[1,8])->get();
//        $notifications_array = $notifications->toArray();
//        foreach ($notifications as  $notification) {
//            $notifications->schedule  = date('Y-m-d H:i:s', $notification['schedule']);
//        }
//        $data['notifications'] = $notifications_array;
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
      
      
      foreach($request->package_type as $package){
        $subs = Subscriptions::where('package_type_id',$package)->get();
        foreach($subs as $sub) {
            $user = $sub->user;
            if(!empty($user->id) && !empty($user->device_token)) {
                $notification = new Notifications;
                $notification->msg = $request->notification;
                $notification->schedule = $send_date;
                $notification->notification_type_id=1;
                $notification->is_sent = 0;
                $notification->user_id = $user->id;
                $notification->created_at = date('Y-m-d H:i:s');
                $notification->packages = $packages;
                $notification->save();
            }
        }
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

        public function notification_lawyer($id)
    {
      $send_date = date('Y-m-d H:i:s',strtotime($_POST['noti_date']));
      $notification = new Notifications;
      $notification->msg = $_POST['notific'];
      $notification->schedule = $send_date;
      $notification->notification_type_id=8;
      $notification->is_sent=0;
      $notification->save();
        $item = new Notification_Items;
        $item->item_id = $id;
        $notification->noti_items()->save($item);

        return response()->json('تمت الإضافه');
    }

        public function notification_for_lawyers()
    {
        $ids = $_POST['ids'];
      $send_date = date('Y-m-d H:i:s',strtotime($_POST['noti_date']));
      $notification = new Notifications;
      $notification->msg = $_POST['notific'];
      $notification->schedule = $send_date;
      $notification->notification_type_id=8;
      $notification->is_sent=0;
      $notification->save();
      foreach($ids as $id){
        $item = new Notification_Items;
        $item->item_id = $id;
        $notification->noti_items()->save($item);
      }

        return response()->json('تمت الإضافه');
    }

    public function filter(Request $request)
    {
        $data['subscription_types'] = Package_Types::all();
        $data['notifications'] = Notifications::where(function($q) use($request){

          $date_from=date('Y-m-d H:i:s',strtotime($request->date_from));
          $date_to=date('Y-m-d 23:59:59',strtotime($request->date_to));

          $q->where('notification_type_id',1);

          $q->whereHas('noti_items',function($q) use($request){
            $q->where('item_id',$request->package);

          });  

          if($request->filled('date_from') && $request->filled('date_to') )
          {
            $q->whereBetween('schedule', array($date_from, $date_to));
        }
        elseif($request->filled('date_from'))
        {
            $q->where('schedule','>=',$date_from);
        }
        elseif($request->filled('date_to'))
        {
            $q->where('schedule','<=',$date_to);
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
        $notification = Notifications::find($id);
        $notification->noti_items()->delete();
        $notification->delete();
    }

    public function notification_cron() {
        $notifications = Notifications::where(function ($query){
            $query->whereIn('notification_type_id',[1,8]);
            $query->where('is_sent',0);
            $query->whereDate('schedule', '<=', date('Y-m-d H:i:s'));
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

                $notification->is_sent = 1;
                $notification->save();   
           }
        }
        dd($notifications);
    }
    public function push_notification() {
        $notifications_push = Notifications_Push::whereNotNull('device_token')->get();
        $results = array();
        foreach($notifications_push as $notification_push) { 
            $device_token = $notification_push->device_token;
            $notification = $notification_push->notification;
            $registrationIds = array($device_token);
            $message = $notification->msg;
            if($notification_push->mobile_os == 'android') {
                $results [] = $this->pushAndroid($registrationIds, $message);
            } else if($notification_push->mobile_os == 'ios') {
                $this->pushIos_pem($device_token,$message,$notification->notification_type_id, $notification->item_id);
            }
            // $notification_table=find($notification_push->notification_id);
            $notification->update(["is_sent" => 1]);
            $notification->save();
            $notification_push->delete();
        }
        dd($results);
    }

    public function pushAndroid($registrationIds,$message) {
        // prep the bundle
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
          curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
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
        $passphrase = 'ss';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'SecureNewPush.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

        $fp = stream_socket_client(
                'ssl://gateway.push.apple.com:2195', $err,
                $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
                exit("Failed to connect: $err $errstr" . PHP_EOL);
        echo 'Connected to APNS' . PHP_EOL;
        $payload = json_encode($body);
        // Build the binary notification
        $pack_hex = $result =  null;
        try {
            $pack_hex = pack('H*', $deviceToken);
        } catch (\Exception $e) { 
            echo $e.' \n';
        }
        
        if(!empty($pack_hex)) {
            $msg = chr(0) . pack('n', 32) . $pack_hex . pack('n', strlen($payload)) . $payload;
            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));
        }
        if (!$result)
                echo 'Message not delivered' . PHP_EOL;
        else
                echo 'Message successfully delivered' . PHP_EOL;

        fclose($fp);
    }
    public function pushIOSP12($deviceToken) {
        //$deviceToken = '6e1326c0e4758b54332fab3b3cb2f9ed92e2cd332e9ba8182f49027054b64d29'; //  iPad 5s Gold prod
        $passphrase = '';
        $message = 'Hello Push Notification';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', public_path('PushDev.p12') ); // Pem file to generated // openssl pkcs12 -in pushcert.p12 -out pushcert.pem -nodes -clcerts // .p12 private key generated from Apple Developer Account
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // production
        // $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); // developement
          echo "<p>Connection Open</p>";
            if(!$fp){
                echo "<p>Failed to connect!<br />Error Number: " . $err . " <br />Code: " . $errstrn . "</p>";
                return;
            } else {
                echo "<p>Sending notification!</p>";    
            }
        $body['aps'] = array('alert' => $message,'sound' => 'default','extra1'=>'10','extra2'=>'value');
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        //var_dump($msg)
        $result = fwrite($fp, $msg, strlen($msg));
          if (!$result)
                    echo '<p>Message not delivered ' . PHP_EOL . '!</p>';
                else
                    echo '<p>Message successfully delivered ' . PHP_EOL . '!</p>';
        fclose($fp);
    }

    
    public function change($id)
    {
        $notification = Notifications::find($id);
        $notification->is_read=1;
        $notification->save();
        // return response()->json('done');
    }

}
