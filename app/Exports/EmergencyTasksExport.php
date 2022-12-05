<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Tasks;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class EmergencyTasksExport implements FromCollection,WithEvents
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
        $tasksArray = array(['كود العميل','اسم العميل','نوع العميل','هاتف','عنوان','التاريخ','الوقت','الحاله','المحامي المحدد']) ;
        if(is_null($this->ids)){

        $tasks = Tasks::where('task_type_id',1)->with(['client'=>function($q){
            $q->with('rules')->get();
        }])->get();
        foreach($tasks as $task)
        {
            $task_status='';
            if($task->task_status_id == 2)
            {
                $task_status='تم';
            }
            else
            {
                $task_status='لم يتم';
            }
            $rule='';
            if(!empty($task->client->rules))
            {
                foreach ($task->client->rules as  $role) 
                {
                if($role->id != '6' && $role->id != '5')
                $rule=$role->name_ar;
                }
            }
            array_push($tasksArray,[$task->client->code,$task->client->name,$rule,$task->client->mobile,$task->client->address,date('d-m-Y', strtotime($task->start_datetime)),date('h:i', strtotime($task->start_datetime)),$task_status,$task->lawyer->name]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $task = Tasks::find($select);
              $task_status='';
            if($task->task_status_id == 2)
            {
                $task_status='تم';
            }
            else
            {
                $task_status='لم يتم';
            }
            $rule='';
            
            if(!empty($task->client->rules))
            {
                foreach ($task->client->rules as  $role) 
                {
                if($role->id != '6' && $role->id != '5')
                $rule=$role->name_ar;
                }
            }
            array_push($tasksArray,[$task->client->code,$task->client->name,$rule,$task->client->mobile,$task->client->address,date('d-m-Y', strtotime($task->start_datetime)),date('h:i', strtotime($task->start_datetime)),$task_status,$task->lawyer->name]);
            } 
        }
        
        return collect($tasksArray);
    }

}
