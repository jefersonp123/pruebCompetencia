<?php

namespace App\Exports;

use App\Autor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;


class AutoresExport implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Autor::all();
    }

    public function headings(): array
    {
        return ['id', 'name', 'lastname','nickname','nationality','biografy','email'];
    }

    public function title(): string
    {
        return 'Autors Report';
    }
}