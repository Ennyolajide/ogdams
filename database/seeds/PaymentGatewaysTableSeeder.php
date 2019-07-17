<?php

use Illuminate\Database\Seeder;

class PaymentGatewaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Payment Gateways Seeds
        DB::table('payment_gateways')->insert([
            'name' => 'Airtime',
            'route' => 'airtime',
        ]);
        DB::table('payment_gateways')->insert([
            'name' => 'Atm Card',
            'route' => 'atm-card',
        ]);
        DB::table('payment_gateways')->insert([
            'name' => 'Bank Transfer',
            'route' => 'bank-transfer',
        ]);
    }
}
