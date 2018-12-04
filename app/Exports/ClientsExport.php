<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Users;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class ClientsExport implements FromCollection,WithEvents,ShouldAutoSize
{
    use Exportable, RegistersEventListeners;
    public function __construct($ids=null, $rule=8,$is_report=null){
      $this->ids=$ids;
      $this->rule = $rule;
      $this->is_report=$is_report;

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
    if(is_null($this->is_report)){
    $usersArray = array(['كود العميل', 'اسم العميل', 'البريد الالكتروني', 'عنوان العميل', 'هاتف', 'نوع الباقة', 'بداية التعاقد', 'نهاية التعاقد', 'حالة التفعيل']) ;

    }else{
$usersArray = array(['كودالشركة','اسم الشركة','نوع التعاقد','عدد العملاء','عدد القضايا']) ;
      }
    if( $this->ids != NULL ){
        $users = Users::whereIn('id', $this->ids)->get();
    } else {
        $users = Helper::getUsersBasedOnRules([$this->rule]);
    }

    foreach($users as $user)
    {
        foreach($user->rules as $rule){
            if($rule->id == 7 || $rule->id == 8 || $rule->id == 9 || $rule->id == 10 )
                $role=$rule->name_ar;
        }
        if(is_null($this->is_report)){
        array_push($usersArray,[$user->code,
                                $user->full_name ? $user->full_name : 'غير معرف',
                                $user->email ? $user->email : 'غير معرف',
                                $user->address ? $user->address : 'غير معرف',
                                $user->mobile ? $user->mobile : 'غير معرف',
                                $user->subscription ? Helper::localizations('package_types', 'name', $user->subscription->package_type_id) : 'غير معرف',
                                $user->subscription ? ( $user->subscription->start_date ? $user->subscription->start_date->format('d/m/Y') : '') : '',
                                $user->subscription ? ( $user->subscription->end_date   ? $user->subscription->end_date->format('d/m/Y') : '') : '',
                                $user->is_active ? 'فعال' : 'غير فعال'
                            ]);
                }else{
               
                array_push($usersArray,[$user->code,
                           $user->full_name ? $user->full_name : 'غير معرف',
                            $user->subscription ? Helper::localizations('package_types', 'name', $user->subscription->package_type_id) : 'غير معرف',
                           $user->companyChildren->count(),
                           $user->clients->count() ]);
              }
    }
    dd($usersArray);
    return collect($usersArray);
}

}
