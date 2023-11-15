<?php

namespace App\Imports;

use App\Model\Prod;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProdImport   implements FromCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function collection()
    {   
        return Prod::all();
    }
}
