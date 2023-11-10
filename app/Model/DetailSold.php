<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DetailSold extends Model
{

	use SoftDeletes;
	
    protected $fillable = [
    	'id_user',
		'id_eleve',
		'type',
		'sold',
		"remrque"
    ];

   

}
