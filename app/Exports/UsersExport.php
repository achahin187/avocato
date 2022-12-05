<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Users;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class UsersExport implements FromCollection,WithEvents
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
    $usersArray = array(['رقم','اسم الموظف','البريد الإلكترونى','نوع العضويه','هاتف','فعال','تاريخ التسجيل','آخر مشاركه']) ;
    if(is_null($this->ids)){

        $users = Users::whereHas('rules', function($q){
            $q->whereIn('name',['super admin','admin','data entry','call center']);
        })->get();
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
                if($rule->id!=13)
                    $role=$rule->name_ar;
            }
            array_push($usersArray,[$user->id,$user->name,$user->email,$role,$user->phone,$is_active,$user->created_at,$user->last_login]);
        }

    }
    else {

        $selects = $this->ids;
        foreach($selects as $select)
        {
    $user = Users::find($select);
            if($user->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($user->rules as $rule){
                if($rule->id!=13)
                    $role=$rule->name_ar;
            }
            array_push($usersArray,[$user->id,$user->name,$user->email,$role,$user->phone,$is_active,$user->created_at,$user->last_login]);
        } 
    }

    return collect($usersArray);
}

}
