<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
class AttendeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $json = File::get(database_path('seeders/json/attendees.json'));
        $attendeess = json_decode($json,true);
        DB::table('attendees')->insert($attendeess);
    }
}
