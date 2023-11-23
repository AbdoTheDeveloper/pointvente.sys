<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Prod extends Model
{

	use SoftDeletes;
	protected $fillable = [
		'id' , 
		'id_user',
		'id_cat',
		'prix_achat',
		'prix_vente',
		'lebelle',
		'qte',
		'qte_alert',
		'img',
		'type',
		'code_bar',
		'unite',
		'remise_max'
    ];
  
}
