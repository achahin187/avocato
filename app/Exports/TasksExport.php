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


class TasksExport implements FromCollection,WithEvents
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
       $casesArray = array(['نوع المهمة','عددالمهام']) ;
       // dd($this->ids);
        if(is_null($this->ids)){

        $tasks = Task_Types::all();
       // dd($installments);
        foreach($tasks as $task)
        {
            // dd($case->governorates->name);
            array_push($casesArray,[
            
        ($task->name) ? Helper::localizations('task_types', 'name', $task->id) : 'لا يوجد',
        ($task->tasks) ? $task->tasks->count() : 0
            ]);
        }

        }
        else {

        $selects = $this->ids;
       
      
       // dd($installments);
        foreach($selects as $select)
        {
              $task = Task_Types::find($select);
              //dd($select);
            array_push($casesArray,[
            
        ($task->name) ? Helper::localizations('task_types', 'name', $task->id) : 'لا يوجد',
        ($task->tasks) ? $task->tasks->count() : 0
            ]);
        }

        }
       // dd($casesArray);
        return collect($casesArray);
    }

}
