<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Tasks;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Helper;

class SessionsExport implements FromCollection,WithEvents
{
    use Exportable, RegistersEventListeners;
	public function __construct($ids=null){
		$this->ids=$ids;
	}




        public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {

                $event->sheet->Bolding('A1:H1');
                $event->sheet->Right();
            }
        ];
    }
    
    public  function collection()
    {   
        $sessionsArray = array(['تاريخ الجلسه','المحكمه / الدائره','رقم الدعوى','الخصم وصفته','ما تم فيها من دفاع وقرارات','القرار','تاريخ الجلسة القادمة','المحامي المحدد']) ;
        if(is_null($this->ids)){

        $sessions = Tasks::where('task_type_id',2)->get();
        foreach($sessions as $session)
        {
            $session['type'] = Helper::localizations('case_client_roles','name',$session->case->contender_case_client_role_id);
            array_push($sessionsArray,[$session->start_datetime,$session->case->courts->name.'/'.$session->case->region,$session->case->claim_number,$session->case->contender_name.'/'.$session->type,$session->name,$session->description,$session->next_datetime,$session->lawyer->full_name]);
        }

        }
        else {

        $selects = $this->ids;
         foreach($selects as $select)
           {
            $session = Tasks::find($select);
            $session['type'] = Helper::localizations('case_client_roles','name',$session->case->contender_case_client_role_id);
            array_push($sessionsArray,[$session->start_datetime,$session->case->courts->name.'/'.$session->case->region,$session->case->claim_number,$session->case->contender_name.'/'.$session->type,$session->name,$session->description,$session->next_datetime,$session->lawyer->full_name]);
            } 
        }
        
        return collect($sessionsArray);
    }

}
