<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_types')->insert([
            ['type' => 'Administrator', 'created_by' => 1],
            ['type' => 'Partner', 'created_by' => 1],
            ['type' => 'Customer', 'created_by' => 1],
        ]);
    }
}
