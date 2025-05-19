<?php

namespace App\Exports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class ClientsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::select('numero', 'nom', 'email', 'telephone', 'adresse','total','paye_total','solde')->get();
    }

    public function headings(): array
    {
        return [
            'Numero',
            'Nom',
            'Email',
            'Telephone',
            'Adresse',
			'Total',
			'Paye_total',
			'Solde'
        ];
    }

 
}
