<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('modules')->insert([
            ['name' => 'Modules', 'slug' => 'modules', 'created_by' => 1],
            ['name' => 'Users Types', 'slug' => 'user_types', 'created_by' => 1],
            ['name' => 'Users', 'slug' => 'users', 'created_by' => 1],
            ['name' => 'Employee Details', 'slug' => 'emp_details', 'created_by' => 1],
            ['name' => 'Roles', 'slug' => 'roles', 'created_by' => 1],
            ['name' => 'Permissions', 'slug' => 'permissions', 'created_by' => 1],
            ['name' => 'Designations', 'slug' => 'designations', 'created_by' => 1],
            ['name' => 'Countries', 'slug' => 'countries', 'created_by' => 1],
            ['name' => 'States', 'slug' => 'states', 'created_by' => 1],
        ]);
    }
}
