<?php

use Illuminate\Database\Seeder;

class BanksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Banks Seeder
        DB::table('banks')->insert([
            'user_id' => 1,
            'acc_no' => '0108211055',
            'acc_name' => 'Eniseyin Olajide',
            'bank_name' => 'Gtbank',
        ]);

        DB::table('banks')->insert([
            'user_id' => 2,
            'acc_no' => '1234567890',
            'acc_name' => 'Test Man',
            'bank_name' => 'First Bank',
        ]);
    }
}
