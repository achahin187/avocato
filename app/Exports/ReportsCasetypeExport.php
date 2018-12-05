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
use Helper;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;


class ReportsCasetypeExport implements FromCollection,WithEvents
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

                $event->sheet->Bolding('A1:K1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $casesArray = array(['نوع القضية','المحافظة','المدينة','إجمالي عدد القضايا']) ;
        if(is_null($this->ids)){

        $cases = Case_::select(['case_type_id', 'geo_city_id', 'geo_governorate_id'])->groupBy('case_type_id')->groupBy('geo_city_id')->groupBy('geo_governorate_id')->get();
        foreach($cases as $case)
        {
            // dd($case->governorates->name);
                 array_push($casesArray,[

              ($case->case_types) ? $case->case_types->name  : 'لا يوجد',
              $case->governorates ? $case->governorates->name : 'لا يوجد',
              $case->cities ? $case->cities->name : 'لا يوجد',
              Helper::countCases($case->case_type_id, $case->cities->id, $case->governorates->id)
            ]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            // $case = Case_::where('id',$select)->select('geo_governorate_id', 'geo_city_id', \DB::raw('count(*) as total'))->first();
             if($select!=''){
               $case = 
                   Case_::select(['case_type_id', 'geo_city_id', 'geo_governorate_id'])-> where('geo_governorate_id',$select)->groupBy('case_type_id')->groupBy('geo_city_id')->groupBy('geo_governorate_id')->first();
            array_push($casesArray,[

              ($case->case_types) ? $case->case_types->name  : 'لا يوجد',
              $case->governorates ? $case->governorates->name : 'لا يوجد',
              $case->cities ? $case->cities->name : 'لا يوجد',
              Helper::countCases($case->case_type_id, $case->cities->id, $case->governorates->id)
            ]);
           }
            } 
        }
       // dd($casesArray);
        return collect($casesArray);
    }

}
