<?php

namespace App\Exports;

use App\Models\Depense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Facture;

class DepenseExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $date_debut;
    protected $date_fin;

    public function __construct($date_debut, $date_fin)
    {
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
    }
    public function collection()
    {
        $factures = Facture::where('type', 'fournisseur')
            ->whereBetween('date', [$this->date_debut, $this->date_fin])
            ->with('fournisseur')
            ->get();
        $data = [];

        foreach ($factures as $facture) {
            $data[] = [
                'Numéro' => $facture->numero, // Numéro
                'Fournisseur' => $facture->fournisseur->nom, // Nom du fournisseur
                'Total_ht' => $facture->facture_ht, // Total HT de la facture
                'TVA' => $facture->facture_tva, // Total TVA de la facture
                'Total_ttc' => $facture->facture_ttc, // Total TTC de la facture
                // ...
            ];
        }

        return collect($data);
    }
    public function headings(): array
    {
        return [
            'Numéro',
            'Fournisseur',
            'Total_ht',
            'TVA',
            'Total_ttc',
        ];
    }
}
