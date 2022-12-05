<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Formula_Contracts;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class FormulasExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null){
		$this->ids=$ids;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:E1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $formulasArray = array(['رقم','اسم العقد أو الصيفه','التصنيف الرئيسي','التصنيف الفرعي','تاريخ الإنشاء']) ;
        if(is_null($this->ids)){

        $formulas = Formula_Contracts::all('id','name','formula_contract_types_id','created_at');
        foreach($formulas as $formula)
        {
            array_push($formulasArray,[$formula->id,$formula->name,$formula->sub->parent->name,$formula->sub->name,$formula->created_at]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $formula =  Formula_Contracts::find($select,['id','name','formula_contract_types_id','created_at']);
            array_push($formulasArray,[$formula->id,$formula->name,$formula->sub->parent->name,$formula->sub->name,$formula->created_at]);
            } 
        }
        
        return collect($formulasArray);
    }

}
