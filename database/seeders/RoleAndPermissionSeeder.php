<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\Groupe;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('permissions')->insert([
        //     'nom' => 'clients',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'catalogues',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'devis',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'factures',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'paiements',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'interventions',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'entreprises',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'taxes',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'categories',
        // ]);
        // DB::table('permissions')->insert([
        //     'nom' => 'utilisateurs',
        // ]);
        $conges = Permission::create([
            'nom' => 'conges',
        ]);
        $conges_admin = Permission::create([
            'nom' => 'conges_admin',
        ]);

        $roles = DB::table('roles')->where('nom', 'Administrateur')->get();
        foreach ($roles as $role) {
            DB::table('permission_role')->insert([
                'role_id' => $role->id,
                'permission_id' => $conges->id,
            ]);
            DB::table('permission_role')->insert([
                'role_id' => $role->id,
                'permission_id' => $conges_admin->id,
            ]);
        }
    }
}
