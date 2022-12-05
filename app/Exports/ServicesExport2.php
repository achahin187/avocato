<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Tasks;
use Helper;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ServicesExport2 implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null){
		$this->ids=$ids;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:E1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $servicesArray = array(['اسم الخدمه','اسم العميل','العنوان','التاريخ','الحاله']) ;
        if(is_null($this->ids)){

        $services = Tasks::where('task_type_id',3)->get();
        foreach($services as $service)
        {
            $service['status'] = Helper::localizations('task_statuses','name',$service->task_status_id);
            array_push($servicesArray,[$service->name,$service->client->full_name,$service->client->address,$service->start_datetime,$service->status]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $service = Tasks::find($select);
            $service['status'] = Helper::localizations('task_statuses','name',$service->task_status_id);
            array_push($servicesArray,[$service->name,$service->client->full_name,$service->client->address,$service->start_datetime,$service->status]);
            } 
        }
        
        return collect($servicesArray);
    }

}
