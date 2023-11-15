<?php

namespace App\Model;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;



class Travailleur  extends Authenticatable
{

    use SoftDeletes;
     use Notifiable;

    //use SoftDeletes;

    protected $guard = 'travailleurs';

    protected $dates = ['deleted_at','created_at','updated_at'];


    protected $fillable = [
                'id_user',
                'nom',
                'username',
                'password',
                'modeCaisse',
                "type",
                "is_manager",
                "canprint"
    ];

 /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function etab()
    {
        return $this->belongsTo('App\Model\User','id_user');
    }

      public function caisse()
      {
          return $this->belongsTo('App\Model\Menu','modeCaisse');
      }

}
