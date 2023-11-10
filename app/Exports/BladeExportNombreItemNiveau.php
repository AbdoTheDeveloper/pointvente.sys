<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BladeExportNombreItemNiveau implements FromView
{

    private $parcours;
    private $items;
    private $niveaux;

    public function __construct($parcours, $items, $niveaux)
    {
        $this->parcours = $parcours;
        $this->items = $items;
        $this->niveaux = $niveaux;
    }


    public function view(): View
    {
        return view('Dir.Statistique.pdf.nbr-item-niveau', [
            'parcours' => $this->parcours,
            'items' => $this->items,
            'niveaux' => $this->niveaux
        ]);
    }
    
    

}
