<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use App\Cases_Types;
use PhpOffice\PhpSpreadsheet\Style;

class CasesExport implements FromCollection,WithColumnFormatting
{
	public function __construct($ids=null){
		$this->ids=$ids;
	}

	    public function columnFormats(): array
    {
        return [
            'A' => getFont()->setBold(true),
            'B' => getFont()->setBold(true),
        ];
    }

    public  function collection()
    {	
        $casesArray = array(['الرقم','النوع']) ;
        if(is_null($this->ids)){

    	$cases = Cases_Types::all('id','name');
    	foreach($cases as $case)
    	{
    		array_push($casesArray,[$case->id,$case->name]);
    	}

        }
        else {

    	$selects = $this->ids;
    	 foreach($selects as $select)
           {
            $case = Cases_Types::find($select,['id','name']);
           	array_push($casesArray,[$case->id,$case->name]);
        	} 
        }
        
        return collect($casesArray);
    }
}