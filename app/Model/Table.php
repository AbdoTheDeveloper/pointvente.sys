<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'nom',
    ];
}
