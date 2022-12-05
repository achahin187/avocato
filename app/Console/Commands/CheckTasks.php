<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Tasks;
use Carbon\Carbon;
use App\User;
use App\Notification_Types;
use App\Notifications;
use App\Notifications_Push;
class CheckTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check If assigned task exeed 10 mintes without acceptence';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tasks = Tasks::where('is_accepted',0)->where('task_type_id',1)->where('assigned_lawyer_id','!=',null)->where("task_assignment_date","<=",Carbon::now()->subSeconds(600)->toDateTimeString())->get();
        foreach($tasks as $task)
        {
            $task->update([
                'is_accepted'=>3
            ]);
            $notification_type=Notification_Types::find(21);
            $client = User::find($task->client_id);
            $lawyer = User::find($task->assigned_lawyer_id);
            $notification=Notifications::create([
                    "msg"=>$notification_type->msg,
                    "entity_id"=>11,
                    "item_id"=>$task->id,
                    "item_name"=>($client)?$client->name:"",
                    "item_user_id"=>($client)?$client->id:"",
                    "user_id"=>$task->assigned_lawyer_id,
                    "notification_type_id"=>21,
                    "is_read"=>0,
                    "is_sent"=>0,
                    'is_push'=>$notification_type->is_push,
                    "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
                ]);
             $notification_push=Notifications_Push::create([
                "notification_id"=>$notification->id,
                "device_token"=>$lawyer->device_token ,
                "mobile_os"=>$lawyer->mobile_os,
                "lang_id"=>$lawyer->lang_id,
                "user_id"=>$lawyer->id
            ]);
            $notification_type=Notification_Types::find(23);
            $notification=Notifications::create([
                "msg"=>$notification_type->msg.$lawyer->name,
                "entity_id"=>11,
                "item_id"=>$task->id,
                "item_name"=>($client)?$client->name:"",
                "item_user_id"=>($client)?$client->id:"",
                "user_id"=>$task->assigned_lawyer_id,
                "notification_type_id"=>23,
                "is_read"=>0,
                "is_sent"=>0,
                'is_push'=>$notification_type->is_push,
                "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
            ]);
            $task->update([
                'task_assignment_date'=>null,
                'assigned_lawyer_id'=>null
            ]);
        }
        
    }
}
