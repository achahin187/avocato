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
       // dd($this->ids);
        if(is_null($this->ids)){

        $installments = $data['installments'] = Installment::all();
       // dd($installments);
        foreach($installments as $ins)
        {
            // dd($case->governorates->name);
            array_push($casesArray,[
            
          ($ins->subscription) ? (Helper::getUserDetails($ins->subscription->user_id) ? Helper::getUserDetails($ins->subscription->user_id)->code : 'لا يوجد')  : 'لا يوجد',
          ($ins->subscription) ? ($ins->subscription->package_type ? Helper::localizations('package_types', 'name', $ins->subscription->package_type->id) : 'لا يوجد') : 'لا يوجد',
          ($ins->installment_number) ? $ins->installment_number : 'لا يوجد',
          ($ins->payment_date) ? $ins->payment_date->format('d-m-Y') : 'لا يوجد',
          ($ins->value) ? $ins->value : 'لا يوجد',
          ($ins->is_paid)?'تم':'-'

             


            ]);
        }

        }
        else {

        $selects = $this->ids;
       
        foreach($selects as $select)
        {
              $ins = $data['installments'] = Installment::find($select);
       // dd($installments);
            array_push($casesArray,[
            
          ($ins->subscription) ? (Helper::getUserDetails($ins->subscription->user_id) ? Helper::getUserDetails($ins->subscription->user_id)->code : 'لا يوجد')  : 'لا يوجد',
          ($ins->subscription) ? ($ins->subscription->package_type ? Helper::localizations('package_types', 'name', $ins->subscription->package_type->id) : 'لا يوجد') : 'لا يوجد',
          ($ins->installment_number) ? $ins->installment_number : 'لا يوجد',
          ($ins->payment_date) ? $ins->payment_date->format('d-m-Y') : 'لا يوجد',
          ($ins->value) ? $ins->value : 'لا يوجد',
          ($ins->is_paid)?'تم':'-'

             


            ]);
        }
        }
       // dd($casesArray);
        return collect($casesArray);
    }

}
