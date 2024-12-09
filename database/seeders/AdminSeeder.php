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
        //
        DB::table('admin')->insert([
            'admin_fname' => 'Ken Mark',
            'admin_lname' => 'Rolloque',
            'admin_mname' => 'L',
            'admin_position' => 'Admin',
            'username' => 'KenMark',
            // 'admin_password' => '12345',
            'password' => Hash::make('12345'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
