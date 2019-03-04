<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Case_;
use App\Users;
use App\Tasks;
use App\Task_Types;
use App\Installment;
use App\Courts;
use App\Cases_Types;
use App\Geo_Cities;
use App\Geo_Governorates;
use App\Geo_Countries;
use App\Package_Types;
use App\User_Details;
use Helper;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;


class UrgentsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null,$type=null){
		$this->ids=$ids;
    $this->type=$type;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:K1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
       $casesArray = array(['كودالعميل','اسم العميل','نوع العميل','عدد حالات الطوارئ']) ;
       
        if(is_null($this->ids)){

        $urgents = Helper::getUrgents([7, 8, 9, 10]);
       
        foreach($urgents as $urgent)
        {
            
            array_push($casesArray,[
            
          ($urgent->code) ? $urgent->code : 'لا يوجد',
          ($urgent->full_name) ? $urgent->full_name : 'لا يوجد',
          ($urgent->rules) ? $urgent->rules->last()->name_ar : 'لا يوجد',
          ($urgent->tasks) ? Helper::countTasks($urgent->id, [1]) : 'لا يوجد'
            ]);
        }

        }
        else {

        $selects = $this->ids;
       
        foreach($selects as $select)
        {
              $urgent = Users::find($select);
           
            array_push($casesArray,[
            
          ($urgent->code) ? $urgent->code : 'لا يوجد',
          ($urgent->full_name) ? $urgent->full_name : 'لا يوجد',
          ($urgent->rules) ? $urgent->rules->last()->name_ar : 'لا يوجد',
          ($urgent->tasks) ? Helper::countTasks($urgent->id, [1]) : 'لا يوجد'
            ]);
        }
        }
       
        return collect($casesArray);
    }

}
