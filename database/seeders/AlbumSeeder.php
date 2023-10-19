<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Albums;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Albums::truncate();

        $csvFile = fopen(base_path("database/data/music.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            if (!$firstline) {
                Albums::create([
                    "name" => $data['1'],
                    "sales" => $data['2'],
                    "year" => $data['3'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
