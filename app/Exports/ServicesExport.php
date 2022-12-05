<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Tasks;
use Helper;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ServicesExport implements FromCollection,WithEvents
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
        $servicesArray = array(['كود العميل','اسم العميل','عنوان العميل','اسم الخدمه','نوع الخدمه']) ;
        if(is_null($this->ids)){

        $services = Tasks::where('task_type_id',3)->get();
        foreach($services as $service)
        {
            $service['type'] = Helper::localizations('task_payment_statuses','name',$service->task_payment_status_id);
            array_push($servicesArray,[$service->client->code,$service->client->full_name,$service->client->address,$service->name,$service->type]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $service = Tasks::find($select);
            $service['type'] = Helper::localizations('task_payment_statuses','name',$service->task_payment_status_id);
            array_push($servicesArray,[$service->client->code,$service->client->full_name,$service->client->address,$service->name,$service->type]);
            } 
        }
        
        return collect($servicesArray);
    }

}
