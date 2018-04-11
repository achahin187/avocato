<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Users;
use Helper;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class LawyersExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
    public function __construct($ids=null){
      $this->ids=$ids;
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
    $lawyersArray = array(['كود المحامي','الإسم','نوع العمل','الرقم القومى','التخصص','درجه القيد بالنقابه','عنوان','رقم الموبايل','تاريخ الإلتحاق','الجنسيه','تفعيل']) ;
    if(is_null($this->ids)){

        $lawyers = Users::whereHas('rules', function($q){
        $q->where('rule_id',[5]);
    })->get();
    foreach($lawyers as $lawyer){
        $lawyer['nationality'] = Helper::localizations('geo_countires','nationality',$lawyer->user_detail->nationality_id);
        if($lawyer->is_active)
        {
            $is_active='فعال';
        }
        else{
            $is_active='غير فعال';
        }
        foreach($lawyer->rules as $rule){
            if($rule->id!=5)
                $role=$rule->name_ar;
        }

        array_push($lawyersArray,[$lawyer->id,$lawyer->name,$role,$lawyer->user_detail->national_id,$lawyer->user_detail->work_sector,$lawyer->user_detail->syndicate_level,$lawyer->address,$lawyer->mobile,$lawyer->user_detail->join_date,$lawyer->nationality,$is_active]);
    }  

    }
    else {

        $selects = $this->ids;
        foreach($selects as $select)
        {
            $lawyer = Users::find($select);
            if($lawyer->is_active)
            {
                $is_active='فعال';
            }
            else{
                $is_active='غير فعال';
            }
            foreach($lawyer->rules as $rule){
                if($rule->id!=5)
                    $role=$rule->name_ar;
            }
            $lawyer['nationality'] = Helper::localizations('geo_countires','nationality',$lawyer->user_detail->nationality_id);
            array_push($lawyersArray,[$lawyer->id,$lawyer->name,$role,$lawyer->user_detail->national_id,$lawyer->user_detail->work_sector,$lawyer->user_detail->syndicate_level,$lawyer->address,$lawyer->mobile,$lawyer->user_detail->join_date,$lawyer->nationality,$is_active]);
        } 
    }

    return collect($lawyersArray);
}

}
