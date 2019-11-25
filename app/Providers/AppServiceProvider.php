<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Illuminate\Support\Facades\Schema;
use App\Notifications;
use Maatwebsite\Excel\Sheet;
use DB;
use App\Users;
use Session;
use App\Tasks;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) 
        {
            // dd(\Session::get('country'));
            //this code will be executed when the view is composed, so session will be available
            $view->with('country', \Session::get('country') );  
            $notes = Notifications::where('country_id', \Session::get('country'))->where('is_push', '=', 0)->where(function ($query) {
                $query->where('is_read', '=', 0)->orWhere(function ($query){
                    $query->where('is_read',1)->whereDate('created_at', DB::raw('CURDATE()'));
                });
    
            })->orderBy('created_at','desc')->get();
               
            foreach($notes as $note){
                if($note->notification_type_id ==2){
    
                $note['url']='task_emergency_view';
                }
                if($note->notification_type_id ==3 ){
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
                if($note->notification_type_id ==25 ){
                    $user = Users::find($note->user_id);
                    
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
                if($note->notification_type_id ==26){
    
                    $note['url']='substitutions.view';
                    }
                if($note->notification_type_id ==4){
    
                $note['url']='complains.edit';
                }
                if($note->notification_type_id ==5 )
                {
                    $type = Tasks::find($note->item_id);
                    if($type == 4)
                    {
                        $note['url']='substitutions.view';
                    }
                    if($type == 3)
                    {
                        $note['url']='services_show';
                    }
                    if($type == 1)
                    {
                        $note['url']='task_emergency_view';
                    }
                }
                if( $note->entity_id==11 ){
    
                $note['url']='services_show';
                }
                if($note->notification_type_id ==5 and $note->entity_id==14 ){
    
                $note['url']='case_view';
                }
                if($note->notification_type_id ==6){
    
                $note['url']='lawyers_show';
                }
                if($note->notification_type_id ==7 || $note->notification_type_id ==14 ){
    
                $note['url']='legal_consultation_view';
                }
                if($note->notification_type_id ==16){
    
                    $note['url']='lawyers_show';
                    }
                    if($note->notification_type_id ==19 || $note->notification_type_id ==20 || $note->notification_type_id ==23){
    
                        $note['url']='task_emergency_view';
                        }
    
            }
            $counter = 0;
            foreach($notes as $note){
                if($note->is_read==0)
                    $counter++;
            }
            // dd($notes);
            \View::share('counter', $counter);
            \View::share('notes', $notes);  
        }); 
        Schema::defaultStringLength(191);
        Sheet::macro('Bolding', function (Sheet $sheet, string $cellRange) {
            $sheet->getDelegate()->getStyle($cellRange)->getFont()->setBold(true);
        });
        Sheet::macro('Right', function (Sheet $sheet) {
            $sheet->getDelegate()->setRightToLeft(true);
        });

        Sheet::macro('Center', function (Sheet $sheet) {
            $sheet->getDelegate()->getPageSetup()->setHorizontalCentered(true);
            $sheet->getDelegate()->getPageSetup()->setVerticalCentered(false);
        });


       
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
