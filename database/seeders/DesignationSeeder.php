<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
    }
}
