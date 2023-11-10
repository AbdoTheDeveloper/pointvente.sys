<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\AdminResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    
    protected $guard = 'admins';
  
    protected $dates = ['deleted_at'];

    
    protected $fillable = [
       'username',
       'nom',
       'email',
       'password', 
       'tele', 
       'logo',
       'grad',
       'msg',
       'p_frns',
       'p_eleve',
       'p_trav',
       'p_stock',
       'p_art',
       'p_cat',
       'p_class',
       'p_niv',
       'p_recette',
       'p_para',
       'p_save',
       'p_users',
    ];
 
 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  public function niveaux() {
      return $this->hasMany('App\Model\Niveau','id_etab')->orderBy('classement');
   }


    public function professeurs()
    {
        return $this->hasMany('App\Model\Professeur','id_etab');
    }


     public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
