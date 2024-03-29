<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Specializations;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class SpecializationsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null){
		$this->ids=$ids;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:B1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $casesArray = array(['الرقم','النوع']) ;
        if(is_null($this->ids)){

        $cases = Specializations::all('id','name');
        foreach($cases as $case)
        {
            array_push($casesArray,[$case->id,$case->name]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $case = Specializations::find($select,['id','name']);
            array_push($casesArray,[$case->id,$case->name]);
            } 
        }
        
        return collect($casesArray);
    }

}
