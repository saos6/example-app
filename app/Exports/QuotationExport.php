<?php

namespace App\Exports;

use App\Models\Quotation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class QuotationExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Quotation::with(['customer', 'person'])->get()->map(function ($quotation) {
            return [
                $quotation->id,
                $quotation->customer->name ?? 'N/A',
                $quotation->person->name ?? 'N/A',
                $quotation->quotation_date,
                $quotation->total_amount,
                $quotation->created_at,
                $quotation->updated_at,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Person Name',
            'Quotation Date',
            'Total Amount',
            'Created At',
            'Updated At',
        ];
    }
}
