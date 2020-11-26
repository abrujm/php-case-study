<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('events')->truncate();

        $file = fopen(dirname(__FILE__) . '/data/events.csv', 'r');
        fgetcsv($file);

        $rows = [];
        while (($data = fgetcsv($file)) !== false) {
            $data = array_map('trim', $data);
            $rows[] = [
              'event_name' => trim($data[0]),
              'event_date' => trim($data[1]),
              'latitude' => trim($data[2]),
              'longitude' => trim($data[3]),
              'location' => DB::raw("(GeomFromText('POINT(".trim($data[2])." ".trim($data[3]).")', 4326))"),
            ];
        }

        fclose($file);
        DB::table('events')->insert($rows);
    }
}
