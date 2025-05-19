<?php

namespace App\Imports;

use App\Models\ContactCrm;
use App\Models\Groupe;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;

class ContactCrmImport implements ToCollection, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
		
        foreach ($rows as $row) {
            $groupe = Groupe::where('nom', 'contact-crm')->first();
            $numero = $groupe->numero();
			//dd($numero);
            if ($numero == false) {
                return response()->json(['error_existe' => "Numéro éxiste déja , changer le numéro prochain dans les parametres"]);
            }
            ContactCrm::create([
                //"numero" => $numero,
                "raison_social" => $row[0],
                "nom" => $row[1],
                "prenom" => $row[2],
                "email" => $row[3],
                "telephone" => $row[4],
                "mobile" => $row[5],
                "secteur" => $row[6],
                "mf" => $row[7],
                "adresse" => $row[8],
              //  "web" => $row[9],
                //"fax" => $row[10],
               // "code_postal" => $row[11],
                //"poste" => $row[12],
                //"linkedin" => $row[13],
                //"facebook" => $row[14],
                //"instagram" => $row[15],
                //"comentaire" => $row[16],
            ]);
            $groupe->nb_prochain++;
            $groupe->save();
        }
    }
    public function startRow(): int
    {
        return 2;
    }
}
