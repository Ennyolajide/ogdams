<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(){

        //Voucher Seeder
        factory(App\Voucher::class, 20)->create();

        //Message Seeder
        factory(App\Message::class, 20)->create();

        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => 'Enny Olajide',
            'email' => 'eniseyinolajide@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'number' => '07063637002',
            'address' => 'no 13 ifelodun',
            'city' => 'abeokuta',
            'state' => 'ogun',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Test Man',
            'email' => 'a@a.com',
            'password' => bcrypt('secret'),
            'number' => '08000000000',
            'city' => 'Moon',
            'state' => 'Universe',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        //Banks Seeder
        DB::table('banks')->insert([
            'user_id' => 1,
            'acc_no' => '0108211055',
            'acc_name' => 'Eniseyin Olajide',
            'bank_name' => 'Gtbank'
        ]);

        DB::table('banks')->insert([
            'user_id' => 2,
            'acc_no' => '1234567890',
            'acc_name' => 'Test Man',
            'bank_name' => 'First Bank'
        ]);


        //Airtime Percetages seeds
        DB::table('airtime_percentages')->insert([
            'network' => 'MTN',
            'airtime_to_cash_percentage' => 75,
            'airtime_swap_percentage' => 90,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('airtime_percentages')->insert([
            'network' => 'AIRTEL',
            'airtime_to_cash_percentage' => 70,
            'airtime_swap_percentage' => 90,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('airtime_percentages')->insert([
            'network' => 'GLO',
            'airtime_to_cash_percentage' => 70,
            'airtime_swap_percentage' => 90,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('airtime_percentages')->insert([
            'network' => '9MOBILE',
            'airtime_to_cash_percentage' => 70,
            'airtime_swap_percentage' => 90,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);


        //data_plans Seeds
            //Mtn
        DB::table('data_plans')->insert([
            'network_id' => 1,
            'network' => 'MTN',
            'volume' => '1 GB',
            'amount' => 500
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 1,
            'network' => 'MTN',
            'volume' => '2 GB',
            'amount' => 1000
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 1,
            'network' => 'MTN',
            'volume' => '3 GB',
            'amount' => 1500
            ]);

            //9mobile
        DB::table('data_plans')->insert([
            'network_id' => 4,
            'network' => '9mobile',
            'volume' => '1 GB',
            'amount' => 650
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 4,
            'network' => '9mobile',
            'volume' => '1.5 GB',
            'amount' => 1000
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 4,
            'network' => '9mobile',
            'volume' => '2 GB',
            'amount' => 1250
            ]);

            //Glo
        DB::table('data_plans')->insert([
            'network_id' => 3,
            'network' => 'Glo',
            'volume' => '1 GB',
            'amount' => 450
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 3,
            'network' => 'Glo',
            'volume' => '2 GB',
            'amount' => 900
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 3,
            'network' => 'Glo',
            'volume' => '4.5 GB',
            'amount' => 1800
            ]);

            //Airtel
        DB::table('data_plans')->insert([
            'network_id' => 2,
            'network' => 'Airtel',
            'volume' => '1.5 GB',
            'amount' => 950
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 2,
            'network' => 'Airtel',
            'volume' => '3.5 GB',
            'amount' => 1890
            ]);
        DB::table('data_plans')->insert([
            'network_id' => 2,
            'network' => 'Airtel',
            'volume' => '5.5 GB',
            'amount' => 2365
            ]);


        //Payment Gateways Seeds
        DB::table('payment_gateways')->insert([
            'name' => 'Airtime',
            'route' => 'airtime'
        ]);
        DB::table('payment_gateways')->insert([
            'name' => 'Atm Card',
            'route' => 'atm-card'
        ]);
        DB::table('payment_gateways')->insert([
            'name' => 'Bank Transfer',
            'route' => 'bank-transfer'
        ]);
        DB::table('payment_gateways')->insert([
            'name' => 'Bitcoin',
            'route' => 'bitcoin'
        ]);
        DB::table('payment_gateways')->insert([
            'name' => 'Ecard',
            'route' => 'ecard'
        ]);

    }
}
