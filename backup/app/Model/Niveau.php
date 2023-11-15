<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Niveau extends Model
{
  
    use SoftDeletes;


   protected $dates = ['deleted_at'];

    
    protected $fillable = [
       'id_etab', 'Desc_niveau','classement'
    ];
    
    
   public function items() {
      return $this->hasMany('App\Model\Item','id_niv');
   }

   public function classes() {
      return $this->hasMany('App\Model\Classe');
   }

  public function certificats()
  {
    return $this->hasMany('App\Model\Certificat','niveau');
  } 

   public function users()
    {
        return $this->belongsTo('App\Model\User');
    } 


}
