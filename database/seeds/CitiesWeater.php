<?php

use Illuminate\Database\Seeder;

class CitiesWeater extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('cities_weater')
                ->insert([
                    'city_name' => $facker->city,
                    'weater' => $facker->numberBetween(1,40),
                    'created_at' => $facker->date(now()),
                    'updated_at' => $facker->date(now()),
                ]);
        }
    }
}
