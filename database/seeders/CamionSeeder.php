<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CamionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<15;$i++){
            DB::table('camions')->insert([
                'marque' => Str::random(10),
                'categorie' => Str::random(10),
                'modele' => Str::random(10),
                'matricule' => $i.'Tunis'.date('Y'),
                'num_chass' => Str::random(10),
                'date_circulation' => '20/06/2005',
                'num_carte' => rand(1000,10000),
                'date_visite' => '20/06/2005',
                'date_assurance' => '20/06/2005',
                'date_vignette' => '20/06/2005',
                'max_volume' => rand(1000,10000),
                'max_tonnage' => rand(1000,10000),
                'kilometrage' => rand(1000,10000),
            ]);

        }
    }
}
