<?php

namespace Database\Seeders;

use App\Models\Award;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class PopulateAwardsTable extends Seeder
{
    public function run(): void
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < 10; $i++) {

            $futureDate = $faker->dateTimeBetween('now', '+3 months');

            Award::create([
                'description' => $faker->name(),
                'local' => $faker->text(),
                'value' => $faker->randomFloat(2, 100, 1000),
                'amount' => $faker->numberBetween(1, 3),
                'date_award' => $futureDate->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
