<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Cases_Types;

class TestExport implements FromCollection
{

    public function collection()
    {
        // return Cases_Types::all();
        $boshy = array('ahmed'=>'ahmed','ahmed'=>'mohamed','ahmed'=>'boshy','ahmed'=>'ay 7aga');
        return collect($boshy);
    }
}