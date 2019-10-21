<?php

use Illuminate\Database\Seeder;

class ChargesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('charges')->insert([
            'service' => 'withdrawals',
            'amount' => 100,
        ]);

        DB::table('charges')->insert([
            'service' => 'addbank',
            'amount' => 100,
        ]);
        DB::table('charges')->insert([
            'service' => 'electricity',
            'amount' => 100,
        ]);
    }
}
