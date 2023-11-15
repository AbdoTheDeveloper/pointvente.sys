<?php

namespace App\Imports;

use App\Model\Professeur;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProfesseurImport   implements FromCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function collection()
    {   
        return Professeur::all();
    }
}
