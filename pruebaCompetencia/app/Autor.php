<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{

    protected $table = 'autors';

    protected $fillable = [
        'name',
        'lastName',
        'nickname',
        'nationality',
        'biografy',
        'email'
    ];

    
}
