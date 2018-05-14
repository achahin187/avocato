<?php 

namespace App\Exports;

use Helper;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\News;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class NewsExport implements FromCollection,WithEvents
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
    $usersArray = array(['رقم المسلسل', 'عنوان الخبر', 'نص الخبر', 'مفعل', 'تاريخ النشر', 'اسم الناشر']) ;

    if( $this->ids != NULL ){
        $news = News::whereIn('id', $this->ids)->get();
    } else {
        $news = News::all();
    }

    foreach($news as $n) {
        $is_active = $n->is_active ? 'نعم' : 'لا';
        $fullname = Helper::getUserDetails($n->created_by) ? Helper::getUserDetails($n->created_by)->full_name : 'غير معروف';
        array_push($usersArray,[ 
            $n->id, 
            $n->name, 
            html_entity_decode(strip_tags($n->body)), 
            $is_active, 
            $n->published_at,  
            $fullname]);
    }

    return collect($usersArray);
}

}
