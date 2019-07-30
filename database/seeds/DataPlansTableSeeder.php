<?php

use Illuminate\Database\Seeder;

class DataPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //data_plans Seeds
        //Mtn
        DB::table('data_plans')->insert([
            'network_id' => 1,
            'network' => 'MTN',
            'volume' => '1 GB',
            'amount' => 500,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 1,
            'network' => 'MTN',
            'volume' => '2 GB',
            'amount' => 1000,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 1,
            'network' => 'MTN',
            'volume' => '3 GB',
            'amount' => 1500,
        ]);

        //9mobile
        DB::table('data_plans')->insert([
            'network_id' => 4,
            'network' => '9mobile',
            'volume' => '1 GB',
            'amount' => 650,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 4,
            'network' => '9mobile',
            'volume' => '1.5 GB',
            'amount' => 1000,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 4,
            'network' => '9mobile',
            'volume' => '2 GB',
            'amount' => 1250,
        ]);

        //Glo
        DB::table('data_plans')->insert([
            'network_id' => 3,
            'network' => 'Glo',
            'volume' => '1 GB',
            'amount' => 450,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 3,
            'network' => 'Glo',
            'volume' => '2 GB',
            'amount' => 900,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 3,
            'network' => 'Glo',
            'volume' => '4.5 GB',
            'amount' => 1800,
        ]);

        //Airtel
        DB::table('data_plans')->insert([
            'network_id' => 2,
            'network' => 'Airtel',
            'volume' => '1.5 GB',
            'amount' => 950,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 2,
            'network' => 'Airtel',
            'volume' => '3.5 GB',
            'amount' => 1890,
        ]);
        DB::table('data_plans')->insert([
            'network_id' => 2,
            'network' => 'Airtel',
            'volume' => '5.5 GB',
            'amount' => 2365,
        ]);
    }
}
