<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Case_;
use App\Users;
use App\Tasks;
use App\Task_Types;
use App\Installment;
use App\Courts;
use App\Cases_Types;
use App\Geo_Cities;
use App\Geo_Governorates;
use App\Geo_Countries;
use App\Package_Types;
use App\User_Details;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;


class ReportsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null,$type=null){
		$this->ids=$ids;
        $this->type=$type;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:B1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $casesArray = array(['المحافظه','المدينه','اجمالى عدد القضايا']) ;
        if(is_null($this->ids)){

        $cases = Case_::where('country_id',session('country'))->select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->groupBy('geo_governorate_id')->groupBy('geo_city_id');
        foreach($cases as $case)
        {
            // dd($case->governorates->name);
            array_push($casesArray,[$case->governorates->name,$case->cities->name,$case->total]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            // $case = Case_::where('id',$select)->select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->first();

               $case = Case_::select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->where('country_id',session('country'))->
                  where('geo_city_id',$select)->groupBy('geo_governorate_id')->groupBy('geo_city_id')->first();
            array_push($casesArray,[$case->governorates->name,$case->cities->name,$case->total]);
            } 
        }
        
        return collect($casesArray);
    }

}
