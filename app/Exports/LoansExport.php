<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoansExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    
    public function view():View
    {
        $loans = Loan::with('client')->get();
        return view('loans.exports',[
            'loans' => $loans
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

}
