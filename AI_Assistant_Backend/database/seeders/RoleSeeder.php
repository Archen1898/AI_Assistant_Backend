<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = Role::create(['name' => 'Administrator']);
       

        $administrator->givePermissionTo('List Income Types');
        $administrator->givePermissionTo('List Income Types By Status');
        $administrator->givePermissionTo('Create Income Type');
        $administrator->givePermissionTo('Update Income Type');


        $user = Role::create(['name' => 'User']);

        $user->givePermissionTo('List Income Types');
        $user->givePermissionTo('List Income Types By Status');
    
    }
}
