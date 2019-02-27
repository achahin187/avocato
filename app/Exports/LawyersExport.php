<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Users;
use Helper;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Session;

class LawyersExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
    public function __construct($ids=null,$is_report=null){
      $this->ids=$ids;
      $this->is_report=$is_report;
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
      if(is_null($this->is_report)){
         $lawyersArray = array(['كود المحامي','الإسم','نوع العمل','الرقم القومى','التخصص','درجه القيد بالنقابه','عنوان','رقم الموبايل','تاريخ الإلتحاق','الجنسيه','تفعيل']) ;
     }else{
       
       $lawyersArray = array(['الاسم','التخصص','درجة التقاضي','الجنسية','نوع العمل','الإختصاص المكاني','عدد المهام','عدد القضايا']) ;
     }
   

    if(is_null($this->ids)){

        $lawyers = Users::where('country_id',session('country'))->whereHas('rules', function($q){
        $q->where('rule_id',[5])
          ->where('rule_id','!=',15);

    })->orderBy('full_name')->get();
    foreach($lawyers as $key=>$lawyer)
    {
      if($lawyer->IsOffice())
      {
        unset($lawyers[$key]);
      }

    }
    foreach($lawyers as $lawyer){
        if(isset($lawyer->user_detail))
        $lawyer['nationality'] = Helper::localizations('geo_countires','nationality',$lawyer->user_detail->nationality_id);
    else
        $lawyer['nationality']='';
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

        $work_sector = '';
        foreach($lawyer->specializations as $spec)
        {
          $work_sector .= $spec->name.' - ';
        }
        
        if(is_null($this->is_report)){
        array_push($lawyersArray,[$lawyer->id,$lawyer->name,$role,$lawyer->user_detail->national_id,$work_sector,$lawyer->user_detail->syndicate_levela->name,$lawyer->address,$lawyer->mobile,$lawyer->user_detail->join_date,$lawyer->nationality,$is_active]);
    }else{
      
       array_push($lawyersArray,[ 
                   ($lawyer->full_name) ? $lawyer->full_name : 'لا يوجد',
                   ($lawyer->user_detail) ? $lawyer->user_detail->work_sector : 'لا يوجد',
                   ($lawyer->user_detail) ? ($lawyer->user_detail->litigation_level ? $lawyer->user_detail->litigation_level :'لا يوجد') : 'لا يوجد' ,
                   ($lawyer->user_detail) ? Helper::localizations('geo_countries', 'nationality', $lawyer->user_detail->nationality_id) : 'لا يوجد',
                   ($lawyer->user_detail) ? $lawyer->user_detail->job_title : 'لا يوجد',
                   ($lawyer->user_detail) ? $lawyer->user_detail->work_sector_type : 'لا يوجد',
                   ($lawyer->tasks) ? $lawyer->tasks->count() : 0 ,
                   ($lawyer->cases) ? $lawyer->cases->count() : 0 
                      ]);
    }

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

              $work_sector = '';
            foreach($lawyer->specializations as $spec)
            {
              $work_sector .= $spec->name.' - ';
            }

            $lawyer['nationality'] = Helper::localizations('geo_countires','nationality',$lawyer->user_detail->nationality_id);
            if(is_null($this->is_report)){
            array_push($lawyersArray,[$lawyer->id,$lawyer->name,$role,$lawyer->user_detail->national_id,$work_sector,$lawyer->user_detail->syndicate_levela->name,$lawyer->address,$lawyer->mobile,$lawyer->user_detail->join_date,$lawyer->nationality,$is_active]);

               }else{
      

     
       array_push($lawyersArray,[ 
                   ($lawyer->full_name) ? $lawyer->full_name : 'لا يوجد',
                   ($lawyer->user_detail) ? $lawyer->user_detail->work_sector : 'لا يوجد',
                   ($lawyer->user_detail) ? ($lawyer->user_detail->litigation_level ? $lawyer->user_detail->litigation_level :'لا يوجد') : 'لا يوجد' ,
                   ($lawyer->user_detail) ? Helper::localizations('geo_countries', 'nationality', $lawyer->user_detail->nationality_id) : 'لا يوجد',
                   ($lawyer->user_detail) ? $lawyer->user_detail->job_title : 'لا يوجد',
                   ($lawyer->user_detail) ? $lawyer->user_detail->work_sector_type : 'لا يوجد',
                   ($lawyer->tasks) ? $lawyer->tasks->count() : 0 ,
                   ($lawyer->cases) ? $lawyer->cases->count() : 0 
                      ]);
    }
        } 
    }
   // dd($lawyersArray);

    return collect($lawyersArray);
}

}
