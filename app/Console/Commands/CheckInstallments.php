<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckInstallments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Installments:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Notification To user before 72 hour with the installment payment';

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
        $installments = UserBouquetPayment::where('notification_sent',0)->where('payment_status',0)->where("start_date","<=",Carbon::now()->subSeconds(72*60)->toDateTimeString())->get();
        foreach($installments as $installment)
        {
            $installment->update([
                'notification_sent'=>1
            ]);
            $notification_type=Notification_Types::find(24);
            $user = User::find($installment->user_id);
            $notification=Notifications::create([
                    "msg"=>$notification_type->msg.$installment->price,
                    "entity_id"=>26,
                    "item_id"=>$installment->id,
                    "item_name"=>($user)?$user->name:"",
                    "item_user_id"=>($user)?$user->id:"",
                    "user_id"=>$user->id,
                    "notification_type_id"=>24,
                    "is_read"=>0,
                    "is_sent"=>0,
                    'is_push'=>$notification_type->is_push,
                    "created_at"=>Carbon::now()->format('Y-m-d H:i:s')
                ]);
             $notification_push=Notifications_Push::create([
                "notification_id"=>$notification->id,
                "device_token"=>$user->device_token ,
                "mobile_os"=>$user->mobile_os,
                "lang_id"=>$user->lang_id,
                "user_id"=>$user->id
            ]);
            
        }
    }
}
