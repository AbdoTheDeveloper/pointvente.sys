<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Stock extends Model
{

	use SoftDeletes;
	protected $fillable = [
		'id_user',
		'id_frns',
		'remarque',
		"date_opt"
    ];
  
}
