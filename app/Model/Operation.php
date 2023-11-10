<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Operation extends Model
{

    use SoftDeletes;
    protected $fillable = [
    	'id_trav',
    	'id_eleve',
        'date_operation',
        'numtick',
        'cloturage',
        'total_a_payer',
        'prix_payer',
        'remise',
        'statut',
        'id_table',
        'id_client',
        'methode_paie'

    ];


     public function DetailOperations()
	  {
	      return $this->hasMany('App\Model\DetailOperation','id_operation');
	  }
}
