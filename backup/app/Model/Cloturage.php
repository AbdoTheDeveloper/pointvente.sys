<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cloturage extends Model
{
    public function operations() {
        return $this->hasMany('App\Model\Operation','cloturage');
     }
}
