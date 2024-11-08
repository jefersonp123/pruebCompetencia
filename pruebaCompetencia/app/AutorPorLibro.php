<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutorPorLibro extends Model
{
    protected $table = 'autor_por_libros';

    protected $fillable = [
        'id_autor',
        'id_libro',
        'type_interaction'
    ];

    public function autor(): BelongsTo
    {
        return $this->belongsTo(Autor::class, 'id_autor');
    }

    public function libro(): BelongsTo
    {
        return $this->belongsTo(Libro::class, 'id_libro');
    }

}
