<?php

use Illuminate\Database\Seeder;

class CoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('coins')->insert([
            'name' => 'bitcoin',
            'buy_rate' => 10,
            'sell_rate' => -20,
            'logo' => 'coins/bitcoin.png',
            'status' => true,
        ]);
        DB::table('coins')->insert([
            'name' => 'ethereum',
            'buy_rate' => 10,
            'sell_rate' => -20,
            'logo' => 'coins/ethereum.png',
            'status' => true,
        ]);
    }
}
