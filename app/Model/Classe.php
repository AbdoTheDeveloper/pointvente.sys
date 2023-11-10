<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Classe extends Model
{
  
    use SoftDeletes;

   protected $dates = ['deleted_at'];

    
    protected $fillable = [
       'nom', 'nbre_elev', 'id_niv'
    ];


	public function niveau()
  {
      return $this->belongsTo('App\Model\Niveau','id_niv');
  } 

  public function eleves() 
  {
      return $this->hasMany('App\Model\Eleve','id_class');
  }

  public function classe_profs() 
  {
      return $this->hasMany('App\Model\Classe_prof');
  }

  public function classe_eleve() 
  {
      return $this->hasMany('App\Model\Classe_eleve');
  }

  public function item_classe() 
  {
      return $this->hasMany('App\Model\Item_classe','id_classe');
  }
}
