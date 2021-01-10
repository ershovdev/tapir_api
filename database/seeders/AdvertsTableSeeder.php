<?php

namespace Database\Seeders;

use App\Models\Advert;
use App\Models\Image;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvertsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Advert::delete();

        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            Advert::create([
                'title' => $faker->title,
                'description' => $faker->paragraph,
                'price' => $faker->numberBetween(0, 100000),
            ]);
        }
    }
}
