<?php

namespace App\Imports;

use App\Models\Lot;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\Client;
use Carbon\Carbon;

class ClientImport implements ToCollection, WithStartRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if(count(Client::all())==0){
                $number=str_pad(1, 4, '0', STR_PAD_LEFT); 
            }
            else{
                $client=Client::orderby('id','desc')->first();
                $number=$client->numero;
                $number = substr($number, 3);
                $number = substr($number, 4);
    
                if($number>=9999){
                    $number=intval($number)+1;
                }
                else{
                $number=str_pad(intval($number)+1, 4, '0', STR_PAD_LEFT); 
                }
            }
            Client::create([
             "numero" => "CLT".Date('Y').$number,
             "nom"=>$row[0],   
             "adresse"=>$row[1],   
             "code_postal"=>$row[2],   
             "telephone"=>$row[3],   
             "fax"=>$row[4],   
             "mobile"=>$row[5],   
             "email"=>$row[6],   
             "web"=>$row[7],   
             "mf"=>$row[8],   
             "categorie_id"=>1,   
             "type"=>'avec_taxe',       
             "status_date" => "valide",
             "status_montant" => "valide",
            ]);
        
        }
    }

    public function startRow(): int
    {
        return 2;
    }

}
