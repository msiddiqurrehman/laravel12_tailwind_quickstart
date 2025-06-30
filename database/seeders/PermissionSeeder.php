<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            ['role_id' => 1, 'module_id' => 1, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 1, 'module_id' => 2, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 1, 'module_id' => 3, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 1, 'module_id' => 4, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 1, 'module_id' => 5, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 1, 'module_id' => 6, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
                        
            ['role_id' => 2, 'module_id' => 1, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 2, 'module_id' => 2, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 2, 'module_id' => 3, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 2, 'module_id' => 4, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 2, 'module_id' => 5, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
            ['role_id' => 2, 'module_id' => 6, 'can_create' => 1, 'can_delete' => 1, 'can_edit' => 1, 'can_view' => 1, 'created_by' => 1],
        ]);
    }
}
