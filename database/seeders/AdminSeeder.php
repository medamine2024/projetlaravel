<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Mohamed Charfi',
            'email' => 'mohamed.charfi@enis.tn',
            'role' => 'admin',
            'password' => Hash::make('azerty22@ENIS')
        ]);
}
}