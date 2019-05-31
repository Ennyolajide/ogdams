<?php

use Illuminate\Database\Seeder;

class BulkSmsConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bulk_sms_configs')->insert([
            'routing' => 2,
            'route' => 'Basic',
            'amount_per_unit' => 200

        ]);

        DB::table('bulk_sms_configs')->insert([
            'routing' => 3,
            'route' => 'Basic & Corporate',
            'amount_per_unit' => 0,
        ]);

        DB::table('bulk_sms_configs')->insert([
            'routing' => 4,
            'route' => 'corporate',
            'amount_per_unit' => 400,
        ]);
    }
}
