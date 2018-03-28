<?php 

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Cases_Types;

class TestExport implements FromCollection
{

    public function collection()
    {
        return Cases_Types::all();
    }
}