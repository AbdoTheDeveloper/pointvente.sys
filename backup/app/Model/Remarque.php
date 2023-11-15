<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Remarque extends Model
{

	use SoftDeletes;
	protected $fillable = [
		'remarque'
    ];

}
