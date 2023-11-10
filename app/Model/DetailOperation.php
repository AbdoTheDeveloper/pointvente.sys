<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DetailOperation extends Model
{

	use SoftDeletes;
    protected $fillable = [
    	'id_user',
    	'id_travailleur',
		'id_hamamt',
		'id_operation',
		'type',
		'prix',
		'qte_operation',
		'remise_appliquee',
		'montant_remis'
    ];

    public function article() 
	  {
	      return $this->belongsTo('App\Model\Prod','id_prod');
	  }

}
