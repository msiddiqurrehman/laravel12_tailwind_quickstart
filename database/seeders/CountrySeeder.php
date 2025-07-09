<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // absolute filepath : laravel_root/storage/app/private/seeder_data/countries.json
        $countries = Storage::json('seeder_data/countries.json');

        DB::table('countries')->insert($countries);
    }
}
