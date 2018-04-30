<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Geo_Cities;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class GovernoratesCitiesExport implements FromCollection,WithEvents
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
    $usersArray = array(['المحافظة', 'المدينة']) ;

    if( $this->ids != NULL ){

        $cities = Geo_Cities::whereIn('id', $this->ids)->get();
        foreach($cities as $city)
        {
            array_push($usersArray,[ $city->governorate->name, $city->name ]);
        }
    }

    return collect($usersArray);
}

}
