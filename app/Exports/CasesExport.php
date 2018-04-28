<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Case_;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class CasesExport implements FromCollection,WithEvents
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
        $casesArray = array(['نوع القضيه','المحكمه','الدائره','رقم الدعوه','السنه','تاريخ قيد الدعوه','رقم الملف بالمكتب']) ;
        if(is_null($this->ids)){

        $cases = Case_::all();
        foreach($cases as $case)
        {
            array_push($casesArray,[$case->case_types->name,$case->courts->name,$case->region,$case->claim_number,$case->claim_year,$case->claim_date,$case->office_file_number]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $case = Case_::find($select);
             array_push($casesArray,[$case->case_types->name,$case->courts->name,$case->region,$case->claim_number,$case->claim_year,$case->claim_date,$case->office_file_number]);
            } 
        }
        
        return collect($casesArray);
    }

}
