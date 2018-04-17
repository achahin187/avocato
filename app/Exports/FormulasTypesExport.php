<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Formula_Contract_Types;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class FormulasTypesExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null){
		$this->ids=$ids;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:C1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $contractsArray = array(['رقم','التصنيف الرئيسي','التصنيف الفرعي']) ;
        if(is_null($this->ids)){

        $subs = Formula_Contract_Types::whereNotNull('parent_id')->get(['id','name','parent_id']);
        foreach($subs as $sub)
        {
            array_push($contractsArray,[$sub->id,$sub->parent->name,$sub->name]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $sub = Formula_Contract_Types::find($select,['id','name','parent_id']);;
            array_push($contractsArray,[$sub->id,$sub->parent->name,$sub->name]);
            } 
        }
        
        return collect($contractsArray);
    }

}
