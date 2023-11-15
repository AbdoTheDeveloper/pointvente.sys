<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Detail_operationProd extends Model
{
	use SoftDeletes;
     protected $fillable = [
     	'id_user',
		'id_hamamt',
		'id_operationProd',
		'prod',
		'qte',
    ];
}
