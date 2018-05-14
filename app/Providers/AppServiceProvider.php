<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use App\Notifications;
use Maatwebsite\Excel\Sheet;
use DB;
use App\Users;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Sheet::macro('Bolding', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
        });
        Sheet::macro('Right', function (Sheet $sheet) {
            $sheet->getDelegate()->setRightToLeft(true);
        });

        $notes = Notifications::whereIn('notification_type_id',[2,3,4,5,6,7])->where(function ($query) {
             $query->where('is_read', '=', 0)->orWhere(function ($query){
                $query->where('is_read',1)->whereDate('created_at', DB::raw('CURDATE()'));
             });

        })->get();
        foreach($notes as $note){
            if($note->notification_type_id ==2){

            $note['url']='task_emergency_view';
            }
            if($note->notification_type_id ==3){
                $user = Users::find($note->item_id);
                if($user->getClient()==8){
                    $note['url']='ind.show';
                }
                if($user->getClient()==9){
                    $note['url']='companies.show';
                }
                if($user->getClient()==10){
                    $note['url']='ind.com.show';
                }
            }
            if($note->notification_type_id ==4){

            $note['url']='complains.edit';
            }
            if($note->notification_type_id ==5 and $note->entity_id==11 ){

            $note['url']='services_show';
            }
            if($note->notification_type_id ==5 and $note->entity_id==14 ){

            $note['url']='case_view';
            }
            if($note->notification_type_id ==6){

            $note['url']='lawyers_show';
            }
            if($note->notification_type_id ==7){

            $note['url']='legal_consultation_view';
            }

        }

        \View::share('notes', $notes);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
