<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'List Income Types']);
        Permission::create(['name' => 'List Income Types By Status']);
        Permission::create(['name' => 'Create Income Type']);
        Permission::create(['name' => 'Update Income Type',]);
    }
}
