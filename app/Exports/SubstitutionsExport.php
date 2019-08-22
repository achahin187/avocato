<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Task;
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
        $casesArray = array(['المحامى المحدد','الحاله ','الدائره','المحكمه',' تاريخ','نوع الانابه','اسم المحامى','كود المحامى']) ;
        if(is_null($this->ids)){

        $cases = Task::where('task_type_id',4)->with(['substitution'=>function($q){
            $q->with('type');
        }])->with('lawyer')->with('lawyer_substitution')->get();
        foreach($cases as $case)
        {
            array_push($casesArray,[$case->lawyer_substitution->code
            ,$case->lawyer_substitution->full_name
            ,$case->substitution->type->name
            ,$case->substitution->date
            ,$case->substitution->court 
            ,$case->substitution->region
            ,$case->task_status_id == 1? 'تم':'لم يتم'
            ,($case->lawyer()->count() != 0 ) ? $case->lawyer->full_name  : 'لم يتم تحديد محامى' ]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $case = Task::where('id',$select)->with(['substitution'=>function($q){
                $q->with('type');
            }])->with('lawyer')->with('lawyer_substitution')->get();
            array_push($casesArray,[$case->lawyer_substitution->code
            ,$case->lawyer_substitution->full_name
            ,$case->substitution->type->name
            ,$case->substitution->date
            ,$case->substitution->court 
            ,$case->substitution->region
            ,$case->task_status_id == 1? 'تم':'لم يتم'
            ,($case->lawyer()->count() != 0 ) ? $case->lawyer->full_name  : 'لم يتم تحديد محامى' ]);
            } 
        }
        
        return collect($casesArray);
    }

}
