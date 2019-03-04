<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use App\Courts;

class CourtsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;

	public function __construct($ids=null,$is_report=null){
		$this->ids=$ids;
        $this->is_report=$is_report;
	}

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:D1');
                $event->sheet->Right();
            }
        ];
    }

    public  function collection()
    {	if(is_null($this->is_report)){
        $courtsArray = array(['الرقم','الاسم','المدينه','المحافظه']) ;
    }else{
        $courtsArray = array(['المدينة','المحافظة','المحكمة','عدد القضايا']) ;
         }
        if(is_null($this->ids)){
       if(is_null($this->is_report)){
    	$courts = Courts::all('id','name','city_id');
    }else{
       $courts = Courts::select('city_id', 'name', \DB::raw('count(*) as total') )->groupBy('city_id')->groupBy('name')->get();
    }
    	foreach($courts as $court)
    	{    if(is_null($this->is_report)){
    		array_push($courtsArray,[$court->id,$court->name,$court->city->name,$court->city->governorate->name]);
        }else{

             array_push($courtsArray,[

                 ($court->city) ? $court->city->name : 'لا يوجد',
                 ($court->city) ? (($court->city->governorate) ? $court->city->governorate->name : 'لا يوجد') : 'لا يوجد',
                 ($court->name) ? $court->name : 'لا يوجد',
                 ($court->cases) ? $court->total : 0 
                 

                 ]);
        }
    	}

        }
        else {
    	$selects = $this->ids;
    	 foreach($selects as $select) {
               if(is_null($this->is_report)){
                $court = Courts::find($select,['id','name','city_id']);
                
                array_push($courtsArray,[$court->id,$court->name,$court->city->name,$court->city->governorate->name]);
                 }else{
                    if($select!='' ){
                    $court = Courts::select('city_id', 'name', \DB::raw('count(*) as total') )->where('name',$select)->groupBy('city_id')->groupBy('name')->first();
               array_push($courtsArray,[

                 ($court->city) ? $court->city->name : 'لا يوجد',
                 ($court->city) ? (($court->city->governorate) ? $court->city->governorate->name : 'لا يوجد') : 'لا يوجد',
                 ($court->name) ? $court->name : 'لا يوجد',
                 ($court->cases) ? $court->total : 0 
                 

                 ]);
            }   
            } 
        }
    }
        return collect($courtsArray);
    }

}