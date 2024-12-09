<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('service')->insert([
            [
                'service' => '9am Service'
            ],
            [
                'service' => '11am Service'
            ],
            [
                'service' => '3pm Service'
            ],            
            [
                'service' => '5pm Service'
            ],            
            [
                'service' => 'Youth Service'
            ]
            ]
            );
    }
}
