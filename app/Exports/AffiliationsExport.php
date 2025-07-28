<?php

namespace App\Exports;

use App\Models\Affiliation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AffiliationsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Affiliation::with('parent')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Parent Name',
        ];
    }

    public function map($affiliation): array
    {
        return [
            $affiliation->id,
            $affiliation->name,
            $affiliation->parent->name ?? '',
        ];
    }
}
