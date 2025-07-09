<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // absolute filepath : laravel_root/storage/app/private/seeder_data/states.json
        $states = Storage::json('seeder_data/states.json');

        DB::table('states')->insert($states);
    }
}
