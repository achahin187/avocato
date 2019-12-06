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
        
                if($note->notification_type_id ==3 ){
                    $user = Users::find($note->item_id);
                    if($user->getClient()==8){
                        $note['url']=route('ind.show',$note->item_id);
                    }
                    if($user->getClient()==9){
                        $note['url']=route('companies.show',$note->item_id);
                    }
                    if($user->getClient()==10){
                        $note['url']=route('ind.com.show',$note->item_id);
                    }
                }
                elseif($note->notification_type_id ==25 ){
                    $user = Users::find($note->user_id);
                    dd($user->getClient());
                    if($user->getClient()==8){
                        $note['url']=route('ind.show',$note->user_id);
                    }
                    if($user->getClient()==9){
                        $note['url']=route('companies.show',$note->user_id);
                    }
                    if($user->getClient()==10){
                        $note['url']=route('ind.com.show',$note->user_id);
                    }
                }
                elseif($note->notification_type_id ==26){
    
                    $note['url']=route('substitutions.view',$note->item_id);
                    }
                elseif($note->notification_type_id ==4){
    
                $note['url']=route('complains.edit',$note->item_id);
                }
                // if( $note->entity_id==11 ){
    
                // $note['url']='services_show';
                // }
                elseif( $note->notification_type_id ==5 || $note->notification_type_id ==27 || $note->notification_type_id ==2|| $note->notification_type_id ==19 || $note->notification_type_id ==20 || $note->notification_type_id ==23)
                {
                    $type = Tasks::find($note->item_id)->task_type_id;
                    
                    if($type == 4)
                    {
                        
                        $note['url']=route('substitutions.view',$note->item_id);
                    }
                    elseif($type == 3)
                    {
                        $note['url']=route('services_show',$note->item_id);
                    }
                    elseif($type == 1)
                    {
                        $note['url']=route('task_emergency_view',$note->item_id);
                    }
                }
                
                elseif($note->notification_type_id ==5 and $note->entity_id==14 ){
    
                $note['url']=route('case_view',$note->item_id);
                }
                elseif($note->notification_type_id ==7 || $note->notification_type_id ==14 ){
    
                $note['url']=route('legal_consultation_view',$note->item_id);
                }
                elseif($note->notification_type_id ==16 || $note->notification_type_id ==6){
    
                    $note['url']=route('lawyers_show',$note->item_id);
                    }
               
                else{
                    $note['url']=route('task_emergency_view',$note->item_id);
                }
    
            }
            $counter = 0;
            foreach($notes as $note){
                if($note->is_read==0)
                    $counter++;
            }
            dd($notes);
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
