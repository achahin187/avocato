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
    public function __construct($ids=null , $is_city = null){
      $this->ids=$ids;
      $this->is_city = $is_city;
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
    $citiesArray = array(['المحافظه' , 'المدينة']) ;
    $governoratesArray = array(['المحافظه']);
    
    if($this->is_city == 1)
    {
        if( $this->ids != NULL ){
            $cities = Geo_Cities::whereIn('id', $this->ids)->get();   
        } else {
            $cities = Geo_Cities::all();  
        }
        foreach($cities as $city) {
            array_push($citiesArray,[  $city->governorate->name ,$city->name ]);
        }

    }
    else
    {
        if( $this->ids != NULL ){
            $cities = Geo_Governorates::whereIn('id', $this->ids)->get();   
        } else {
            $cities = Geo_Governorates::all();  
        }
        foreach($cities as $city) {
            array_push($governoratesArray,[  $city->name ]);
        }

    }

    

   

    return collect($usersArray);
}

}
