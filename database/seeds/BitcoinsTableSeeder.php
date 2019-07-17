<?php

use Illuminate\Database\Seeder;

class BitcoinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bitcoins')->insert([
            'rate' => 360,
            'status' => true,
            'action' => 'buy',
            'contact' => '2347031641487',
            'logo' => 'coins/bitcoin.png',
            'description' => 'buying from us..(selling to you)'
        ]);
        DB::table('bitcoins')->insert([
            'rate' => 360,
            'status' => true,
            'action' => 'sell',
            'contact' => '2347031641487',
            'logo' => 'coins/bitcoin.png',
            'description' => 'selling to us..(buying from you)'
        ]);
    }
}
