<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Users;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ClientsExport implements FromCollection,WithEvents
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
    $usersArray = array(['كود العميل', 'اسم العميل', 'البريد الالكتروني', 'عنوان العميل', 'هاتف', 'نوع الباقة', 'بداية التعاقد', 'نهاية التعاقد', 'حالة التفعيل']) ;

    if( $this->ids != NULL ){

        $users = Users::whereIn('id', $this->ids)->get();
        foreach($users as $user)
        {
            if($user->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($user->rules as $rule){
                if($rule->id == 7 || $rule->id == 8 || $rule->id == 9 || $rule->id == 10 )
                    $role=$rule->name_ar;
            }
            array_push($usersArray,[$user->code,
                                    $user->full_name,
                                    $user->email,
                                    $user->address,
                                    $user->mobile,
                                    Helper::localizations('package_types', 'name', $user->subscription->package_type_id),
                                    $user->subscription->start_date,
                                    $user->subscription->end_date,
                                    $is_active
                                ]);
        }

    }

    return collect($usersArray);
}

}
