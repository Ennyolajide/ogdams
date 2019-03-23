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
            'image_link' => 'bitcoin.png',
            'status' => true,
        ]);
        DB::table('coins')->insert([
            'name' => 'ethereum',
            'image_link' => 'ethereum.png',
            'status' => true,
        ]);
    }
}
