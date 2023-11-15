<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Failedjob extends Model
{

	protected $fillable = [
        'code_bar',
        'nom_produit',
        'qte',
        'date_failed'
    ];

}

