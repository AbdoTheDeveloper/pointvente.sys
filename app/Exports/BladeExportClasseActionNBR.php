<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BladeExportClasseActionNBR implements FromView
{

    private $parcours;
    private $classes;
    private $niveaux;

    public function __construct($parcours, $niveaux, $classes)
    {
        $this->parcours = $parcours;
     
        $this->niveaux = $niveaux;

       $this->classes = $classes;
    }


    public function view(): View
    {
        return view('Dir.Statistique.pdf.pourcentage-classe-acion', [
            'parcours' => $this->parcours,
            'classes' => $this->classes,
            'niveaux' => $this->niveaux
        ]);
    }
    
    
 
}
