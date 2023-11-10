<?php

namespace App\Imports;

use App\Model\Classe;
use Maatwebsite\Excel\Concerns\FromCollection;

class ClasseImport   implements FromCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function collection()
    {   
        return Classe::all();
    }
}
