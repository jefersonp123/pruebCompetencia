<?php

namespace App\Exports;

use App\Libro;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;


class LibrosExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Libro::all();
    }

    public function headings(): array
    {
        return ['id', 'title', 'year_publication','gender','editorial','summary','pages'];
    }

    public function title(): string
    {
        return 'Libros Report';
    }
}