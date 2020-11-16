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
                    'name' => $this->getRandomKey(),
                    'start_date' => $facker->dateTimeBetween('-90 days','now'),
                    'end_date' => $facker->dateTimeBetween('-90 days','now'),
                ]);
        }
    }

    public function getRandomKey()
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;
    }
}
