<?php

namespace App\Imports;

use App\Model\Niveau;
use Maatwebsite\Excel\Concerns\FromCollection;

class NiveauImport   implements FromCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function collection()
    {   
        return Niveau::all();
    }
}
