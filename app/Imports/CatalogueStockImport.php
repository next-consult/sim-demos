<?php

namespace App\Imports;

use App\Models\Catalogue;
use App\Models\Stock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CatalogueStockImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $catalogue = Catalogue::where('numero', $row['numero'])->first();

        if (!$catalogue) {
            return null;
        }

        $stockRecord = Stock::where('idcatalogue', $catalogue->id)->first();

        if (!$stockRecord) {
            return null;
        }

        $newTotal = $stockRecord->qte + $row['qte'];
        $stockRecord->update(['qte' => $newTotal]);

        return null;
    }
}
