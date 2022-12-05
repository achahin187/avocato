<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Record;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class RecordsExport implements FromCollection,WithEvents
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
    $recordsArray = array(['رقم الاعلان', 'قلم المحضرين', 'اسم الموكل', 'تاريخ التسليم', 'تاريخ التسلم', 'تاريخ الجلسة', 'ملاحظات']) ;

    if( $this->ids != NULL ){
        $records = Record::whereIn('id', $this->ids)->get();
    } else {
        $records = Record::all();
    }

    foreach($records as $record) {
        array_push($recordsArray,[ 
            $record->number ? $record->number : 'لا يوجد',
            $record->pen ? $record->pen : 'لا يوجد',
            $record->client_id ? Helper::getUserDetails($record->client_id)->full_name : 'لا يوجد',
            $record->delivery_date ? $record->delivery_date->format('d/m/Y') : 'لا يوجد',
            $record->delivered_at  ? $record->delivered_at->format('d/m/Y')  : 'لا يوجد',
            $record->session_date  ? $record->session_date->format('d/m/Y')  : 'لا يوجد',
            $record->notes ? $record->notes : 'لا يوجد' 
        ]);
    }

    return collect($recordsArray);
}

}
