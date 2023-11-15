<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Operation_prod extends Model
{
	use SoftDeletes;
    protected $fillable = [
     	'id_user',
		'remarque',
		'date',
    ];
}
