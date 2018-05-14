<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Feedback;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ComplainsExport implements FromCollection,WithEvents
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
    $complainsArray = array(['كود العميل', 'اسم العميل', 'نص الشكوي', 'تاريخ الشكوي', 'تم الرد']) ;

    if( $this->ids != NULL ){
        $complains = Feedback::whereIn('id', $this->ids)->get();
    } else {
        $complains = Feedback::all();
    }

    foreach($complains as $complain) {
        array_push($complainsArray,[ 
            $complain->user_id ? $complain->user_id : '',
            $complain->name ? $complain->name : Helper::getUserDetails($complain->user_id),
            $complain->body ? $complain->body : '',
            $complain->created_at ? $complain->created_at : '',
            $complain->is_replied ? 'نعم' : 'لا'
        ]);
    }

    return collect($complainsArray);
}

}
