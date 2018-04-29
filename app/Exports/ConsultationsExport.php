<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use App\Consultation;

class ConsultationsExport implements FromCollection,WithEvents
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
        $cosultationsArray = array(['كود','تصنيف','سؤال الأستشاره','تاريخ الاستشاره','النوع','تم الرد']) ;
        if(is_null($this->ids)){

    	$consultations = Consultation::all();
    	foreach($consultations as $consultation)
    	{
            $is_paid='';
            $is_replied='';
            if($consultation->is_paid == 1)
            {
                $is_paid='مدفوعه';
            }
            else
            {
                $is_paid='مجانيه';
            }
            if($consultation->is_replied == 1)
            {
                $is_replied='نعم';
            }
            else
            {
                $is_replied='لا';
            }
    		array_push($cosultationsArray,[$consultation->code,$consultation->consultation_type->name,$consultation->question,$consultation->created_at,$is_paid,$is_replied]);
    	}

        }
        else {

    	$selects = $this->ids;
    	 foreach($selects as $select)
           {
            $consultation = Consultation::find($select);
             $is_paid='';
            $is_replied='';
            if($consultation->is_paid == 1)
            {
                $is_paid='مدفوعه';
            }
            else
            {
                $is_paid='مجانيه';
            }
            if($consultation->is_replied == 1)
            {
                $is_replied='نعم';
            }
            else
            {
                $is_replied='لا';
            }
           	array_push($cosultationsArray,[$consultation->code,$consultation->consultation_type->name,$consultation->question,$consultation->created_at,$is_paid,$is_replied]);
        	} 
        }
        
        return collect($cosultationsArray);
    }
}