<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StocksImportMaterial implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {


        return new Stock([
            'idcategorie' => 3,
            'catalogue_id' => $row['produit'],
            'nom' => $row['nom'],
            'qte' => $row['quantite'],
            'emplacement_id' => $row['emplacement_id'],

        ]);
    }
}
