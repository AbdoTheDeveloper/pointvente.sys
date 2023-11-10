<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdStock extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_user',
        'id_operationStock',
        'id_prod',
        'qteEntrer',
        'prixEntre'
    ];
}
