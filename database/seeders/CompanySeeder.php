<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 6; $i++) { 
            $faker = Faker::create();
            DB::table('companies')->insert([
                'name' => $faker->company,
                'email' => $faker->email,
                'telephone' => $faker->phoneNumber,
                'website' => $faker->url
            ]);
        }
    }
}
