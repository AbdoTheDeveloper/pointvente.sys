<?php

namespace App\Imports;

use App\Model\Eleve;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class EleveImport   implements FromCollection, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   


    public function collection()
    {   
        return Eleve::all();
    }

     public function chunkSize(): int
    {
        return 1000;
    }
}
