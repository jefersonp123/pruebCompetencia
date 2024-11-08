<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $table = 'libros';

    protected $fillable = [
        'title',
        'year_publication',
        'gender',
        'editorial',
        'summary',
        'pages'
    ];
}
