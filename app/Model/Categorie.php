<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
     protected $fillable = [
    	'id_user',
        'nom_cat',
        'img',
        'type'
    ];
}
