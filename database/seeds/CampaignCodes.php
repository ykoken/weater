<?php

use Illuminate\Database\Seeder;

class CampaignCodes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table('campaign_codes')
                ->insert([
                    'name' => $facker->randomNumber(),
                    'start_date' => $facker->dateTimeBetween('-90 days','now'),
                    'end_date' => $facker->dateTimeBetween('-90 days','now'),
                ]);
        }
    }
}
