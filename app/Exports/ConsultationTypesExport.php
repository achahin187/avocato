<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Consultation_Types;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ConsultationTypesExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
    public function __construct($ids=null){
      $this->ids=$ids;
  }




  public function registerEvents(): array
  {
    return [
        AfterSheet::class    => function(AfterSheet $event) {

            $event->sheet->Bolding('A1:H1');
            $event->sheet->Right();
        }
    ];
}

public  function collection()
{   
    $usersArray = array(['اسم التصنيف']) ;

    if( $this->ids != NULL ){

        $types = Consultation_Types::whereIn('id', $this->ids)->get();
        foreach($types as $type)
        {
            array_push($usersArray,[ $type->name ]);
        }
    }

    return collect($usersArray);
}

}
