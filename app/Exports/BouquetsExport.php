<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Bouquet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class BouquetsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null){
		$this->ids=$ids;
       
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
        $bouquetsArray = array(['اسم الباقه','تصنيف الباقه','دفع الاقساط',' عدد المشتركين']) ;
        if(is_null($this->ids)){

        $bouquets = Bouquet::with('price_relation')->with('payment')->with('services')->with('users')->where('country_id',session('country'))->get();
        
        foreach($bouquets as $bouquet)
        {
            $payment = '';
            foreach($bouquet['payment'] as $value)
            {
                $payment .= $value['name'] . '-';
            } 
            array_push($bouquetsArray,[$bouquet['name']
            ,($bouquet['bouquet_type'] == 0) ? 'أفراد' : 'شركات' 
            ,$payment
            ,count($bouquet->users)]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $bouquet = Bouquet::where('id',$select)->with('price_relation')->with('payment')->with('services')->with('users')->where('country_id',session('country'))->first();

            $payment = '';
            foreach($bouquet['payment'] as $value)
            {
                $payment .= $value['name'] . '-';
            } 
            array_push($bouquetsArray,[$bouquet['name']
            ,($bouquet['bouquet_type'] == 0) ? 'أفراد' : 'شركات' 
            ,$payment
            ,count($bouquet->users)]);
        }
        }
        
        return collect($bouquetsArray);
    }

}
