<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Case_;
use App\Users;
use App\Tasks;
use App\Task_Types;
use App\UserBouquetPayment;
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


class InstallmentsExport implements FromCollection,WithEvents
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
        $casesArray = array(['كود العميل','نوع التعاقد','ترتيب القسط','التاريخ','القيمة','حالة الدفع']) ;
       
        if(is_null($this->ids)){

        $installments = $data['installments'] = UserBouquetPayment::all();
        foreach($installments as $ins)
        {
            array_push($casesArray,[
            
          ($ins->user_id) ? (Helper::getUserDetails($ins->user_id) ? Helper::getUserDetails($ins->user_id)->code : 'لا يوجد')  : 'لا يوجد',
          ($ins->bouquet_id) ? ($ins->bouquet ? $ins->bouquet->name : 'لا يوجد') : 'لا يوجد',
          ($ins->period) ? $ins->peiod : 'لا يوجد',
          ($ins->start_date) ? $ins->start_date : 'لا يوجد',
          ($ins->price) ? $ins->price : 'لا يوجد',
          ($ins->payment_status)?'تم':'-'

             


            ]);
        }

        }
        else {

        $selects = $this->ids;
       
        foreach($selects as $select)
        {
              $ins = $data['installments'] = UserBouquetPayment::find($select);

            array_push($casesArray,[
            
                ($ins->user_id) ? (Helper::getUserDetails($ins->user_id) ? Helper::getUserDetails($ins->user_id)->code : 'لا يوجد')  : 'لا يوجد',
                ($ins->bouquet_id) ? ($ins->bouquet ? $ins->bouquet->name : 'لا يوجد') : 'لا يوجد',
                ($ins->period) ? $ins->peiod : 'لا يوجد',
                ($ins->start_date) ? $ins->start_date : 'لا يوجد',
                ($ins->price) ? $ins->price : 'لا يوجد',
                ($ins->payment_status)?'تم':'-'
             


            ]);
        }
        }

        return collect($casesArray);
    }

}
