<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<20;$i++){
            DB::table('clients')->insert([
                'nom' => Str::random(10),
                'email' => Str::random(10).'@gmail.com',
                'prenom' => Str::random(10),
                'telephone' => Str::random(10),
                'mobile' => Str::random(10),
                'mf' => Str::random(10),
                'rne' => Str::random(10),
                'adresse' => Str::random(10),
                'code_postal' => Str::random(10),
            ]);

        }
   
    }
}
