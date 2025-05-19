<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ChauffeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<50;$i++){
            DB::table('chauffeurs')->insert([
                'type_permis' => "B",
                'cin' => rand(10000000,99999999),
                'date_cin' => '20/06/2005',
                'type_permis' => Str::random(10),
                'date_permis' => '20/06/2005',
                'kilometrage' => rand(100,10000),
                'nom' => 'chauffeur_nom'.$i,
                'prenom' => 'chauffeur_prenom'.$i,
                'date_naissance' => '20/06/2005',
                'telephone' => rand(1,10),
            ]);
        }
    }
}
