<?php

namespace App\Imports;

use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StocksImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Convertir les dates Excel en format DateTime
        $dateStart = null;
        if (!empty($row['date_start'])) {
            if (is_numeric($row['date_start'])) {
                $dateStart = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_start']);
            } else {
                $dateStart = Carbon::createFromFormat('d/m/Y', $row['date_start']);
            }
        }

        $dateExpiration = null;
        if (!empty($row['date_expiration'])) {
            if (is_numeric($row['date_expiration'])) {
                $dateExpiration = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_expiration']);
            } else {
                $dateExpiration = Carbon::createFromFormat('d/m/Y', $row['date_expiration']);
            }
        }

        return new Stock([
            'idcategorie' => 1,
            'catalogue_id' => $row['produit'],
            'nom' => $row['nom'],
            'qte' => $row['quantite'],
            'emplacement_id' => $row['emplacement'],
            'date_start' => $dateStart,
            'date_expiration' => $dateExpiration,
            'code' => $row['code'],
        ]);
    }
}
