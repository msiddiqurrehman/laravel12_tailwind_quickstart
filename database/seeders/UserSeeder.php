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
                'email' => 'systemcreator@mailinator.com',
                'password' => Hash::make('systemcreator'),
                'created_by' => 1,
            ],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'superadmin@mailinator.com',
                'password' => Hash::make('superadmin'),
                'created_by' => 1,
            ],
            [
                'first_name' => 'Administrator',
                'last_name' => '',
                'email' => 'administrator@mailinator.com',
                'password' => Hash::make('administrator'),
                'created_by' => 1,
            ],
            [
                'first_name' => 'Partner',
                'last_name' => 'LName',
                'email' => 'partner_lname@mailinator.com',
                'password' => Hash::make('partner_lname'),
                'created_by' => 1,
            ],
            [
                'first_name' => 'Customer',
                'last_name' => 'LName',
                'email' => 'cusomer_lname@mailinator.com',
                'password' => Hash::make('cusomer_lname'),
                'created_by' => 1,
            ],
        ]);
    }
}
