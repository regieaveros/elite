<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artists;

class ArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artists::truncate();

        $csvFile = fopen(base_path("database/data/music.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Artists::create([
                    "name" => $data['0'],
                    "code" => fake()->hexcolor(),
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
