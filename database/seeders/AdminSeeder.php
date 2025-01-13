<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Mohamed Charfi',
            'email' => 'mohamed.charfi@enis.tn',
            'role' => 'admin',
            'password' => Hash::make('azerty22'), 
        ]);
    }
}
