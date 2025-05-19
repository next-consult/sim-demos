<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ItemDevisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
            DB::table('itemdevis')->insert([
                'description' => Str::random(10),
                'quantites' => rand(1,10),
                'unite' => rand(1,10),
                'prix_ht' => rand(1,10),
                'tva' => '7',
                'prix_tva' => rand(1,10),
                'prix_ttc' =>rand(1,10),
                'devis_id' =>'1',
   
            ]);

        }
    }
}
