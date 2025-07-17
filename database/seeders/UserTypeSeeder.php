<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_types')->insert([
            ['type' => 'Staff', 'created_by' => 1],
            ['type' => 'Partner', 'created_by' => 1],
            ['type' => 'Customer', 'created_by' => 1],
        ]);

        DB::table('users')->whereIn('id', [1, 2, 3])->update(['user_type_id' => 1]);
        DB::table('users')->whereIn('id', [4])->update(['user_type_id' => 2]);
        DB::table('users')->whereIn('id', [5])->update(['user_type_id' => 3]);
    }
}
