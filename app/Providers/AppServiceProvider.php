<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use App\Notifications;
use Maatwebsite\Excel\Sheet;

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

        $notes = Notifications::where('notification_type_id','!=',1)->get();
        foreach($notes as $note){
            if($note->notification_type_id ==2){

            $note['url']="route('task_emergency_view',$note->item_id)";
            }
            if($note->notification_type_id ==4){

            $note['url']="route('complains.edit',$note->item_id)";
            }
            if($note->notification_type_id ==5 and $note->entity_id==11 ){

            $note['url']="route('services_show',$note->item_id)";
            }
            if($note->notification_type_id ==5 and $note->entity_id==14 ){

            $note['url']="route('case_view',$note->item_id)";
            }
            if($note->notification_type_id ==6){

            $note['url']="route('lawyers_show',$note->item_id)";
            }
            if($note->notification_type_id ==7){

            $note['url']="route('legal_consultation_view',$note->item_id)";
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
