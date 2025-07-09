<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('designations')->insert([
            ['title' => 'CEO', 'created_by' => 1],
            ['title' => 'COO', 'created_by' => 1],
            ['title' => 'Manager', 'created_by' => 1],
            ['title' => 'Account Manager', 'created_by' => 1],
            ['title' => 'Sales Manager', 'created_by' => 1],
        ]);

        DB::table('emp_details')->insert(['user_id' => 3, 'designation_id' => 1]);
    }
}
