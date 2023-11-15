<?php

namespace App\Model;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EleveResetPasswordNotification;

class Eleve extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $guard = 'eleves';
  
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
      protected  $fillable = [
        'id_etab', 'id_class', 'nom', 'age', 'prenom', 'adress', 'tele','img', 'email', 'password','username','delegue'
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

     

    protected $dates = ['deleted_at'];

    public function classe()
    {
        return $this->belongsTo('App\Model\Classe','id_class');
    } 

    public function eleve_delegue()
    {
        return $this->belongsTo('App\Model\Eleve_delegue','id_eleve');
    }


     public function etab()
    {
        return $this->belongsTo('App\Model\User','id_etab');
    }

   public function actions() {
      return $this->hasMany('App\Model\Action','id_elv')->where('actions.archive', '0')->orWhere('actions.archive', null);
   }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EleveResetPasswordNotification($token));
    }


}
