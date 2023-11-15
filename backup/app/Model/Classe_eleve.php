<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class classe_eleve extends Model
{
    //
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    
    protected $fillable = [
       'id_classe', 'id_eleve',
    ];
    

  	public function classe() {
        return $this->belongsTo('App\Model\Classe','id_classe');
     }

   public function eleve()
    {
        return $this->belongsTo('App\Model\Eleve','id_eleve');
    }
}
