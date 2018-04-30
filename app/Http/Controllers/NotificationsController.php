<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package_Types;
use App\Notifications;
use App\Notification_Items;
use Validator;

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

      $send_date = date('Y-m-d H:i:s',strtotime($request->date));
      $notification = new Notifications;
      $notification->msg = $request->notification;
      $notification->schedule = $send_date;
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
        //
    }
}
