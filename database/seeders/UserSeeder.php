<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'System',
                'last_name' => 'Creator',
                'email' => 'htnt_systemcreator@mailinator.com',
                'password' => Hash::make('htnt_systemcreator'),
                'created_by' => 1,
            ],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'htnt_superadmin@mailinator.com',
                'password' => Hash::make('htnt_superadmin'),
                'created_by' => 1,
            ],
            [
                'first_name' => 'Administrator',
                'last_name' => '',
                'email' => 'htnt_administrator@mailinator.com',
                'password' => Hash::make('htnt_administrator'),
                'created_by' => 1,
            ],
        ]);
    }
}
