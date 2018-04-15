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

	public function __construct($ids=null){
		$this->ids=$ids;
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
    {	
        $courtsArray = array(['الرقم','الاسم','المدينه','المحافظه']) ;
        if(is_null($this->ids)){

    	$courts = Courts::all('id','name','city_id');
    	foreach($courts as $court)
    	{
    		array_push($courtsArray,[$court->id,$court->name,$court->city->name,$court->city->governorate->name]);
    	}

        }
        else {

    	$selects = $this->ids;
    	 foreach($selects as $select)
           {
            $court = Courts::find($select,['id','name','city_id']);
           	array_push($courtsArray,[$court->id,$court->name,$court->city->name,$court->city->governorate->name]);
        	} 
        }
        
        return collect($courtsArray);
    }
}