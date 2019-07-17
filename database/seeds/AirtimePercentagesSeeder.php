<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AirtimePercentagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        //Airtime Percetages seeds
        DB::table('airtime_percentages')->insert([
            'network' => 'MTN',
            'airtime_to_cash_percentage' => 75,
            'airtime_swap_percentage' => 75,
            'airtime_to_cash_phone_numbers' => json_encode(['07088776655', '07055443322']),
            'transfer_code' => '* 600 * recipient-number * amount * pin #',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('airtime_percentages')->insert([
            'network' => 'AIRTEL',
            'airtime_to_cash_percentage' => 70,
            'airtime_swap_percentage' => 70,
            'airtime_to_cash_phone_numbers' => json_encode(['07088776655', '07055443322']),
            'transfer_code' => '* 123 * recipient-number * amount * pin #',
            'airtime_to_cash_percentage_status' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('airtime_percentages')->insert([
            'network' => 'GLO',
            'airtime_to_cash_percentage' => 70,
            'airtime_swap_percentage' => 70,
            'airtime_to_cash_phone_numbers' => json_encode(['07088776655', '07055443322']),
            'transfer_code' => '* 131 * recipient-number * amount * pin #',
            'airtime_to_cash_percentage_status' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('airtime_percentages')->insert([
            'network' => '9MOBILE',
            'airtime_to_cash_percentage' => 70,
            'airtime_swap_percentage' => 70,
            'airtime_to_cash_phone_numbers' => json_encode(['07088776655', '07055443322']),
            'transfer_code' => '* 232 * pin * amount * recipient-number #',
            'airtime_to_cash_percentage_status' => false,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
