<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToModel, WithHeadingRow
{
    use Importable;

    public function model(array $row)
    {
        dd($row);
        return new Client([
            'name' => $row['name'],
        ]);
    }
}
