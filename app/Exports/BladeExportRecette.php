<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BladeExportRecette implements FromView
{

    private $cloturages;

    public function __construct($cloturages)
    {
        $this->cloturages = $cloturages;
    }


    public function view(): View
    {
        return view('Admin.recette.excel', [
            'cloturages' => $this->cloturages,
        ]);
    }
    
    
 
}
