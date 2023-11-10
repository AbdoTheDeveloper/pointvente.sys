<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Parametrage extends Model
{

	protected $fillable = [
		'enable_cusisine',
		'enable_barman',
		'cloturage_v1',
		'cloturage_v2',
		'table_select',
		'remarque_select'
    ];

}
