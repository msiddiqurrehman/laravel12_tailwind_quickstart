<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['title' => 'System', 'created_by' => 1],
            ['title' => 'Superadmin', 'created_by' => 1],
            ['title' => 'Administrator', 'created_by' => 1],
        ]);
    }
}
