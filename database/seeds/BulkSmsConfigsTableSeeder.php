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
            'amount_per_unit' => 200,
            'route' => 'Basic ( Non DND )',
            'description' => 'Sms to DND numbers will not be delivered or Charged'
        ]);

        DB::table('bulk_sms_configs')->insert([
            'routing' => 3,
            'amount_per_unit' => 0,
            'route' => 'Basic & Corporate( DND and Non DND )',
            'description' => 'Sms to DND & non DND numbers will be delivered with seperate charges'
        ]);

        DB::table('bulk_sms_configs')->insert([
            'routing' => 4,
            'amount_per_unit' => 400,
            'route' => 'Corporate ( DND )',
            'description' => 'Sms to DND numbers will be delivered (Assumes all numbers are DND)'
        ]);
    }
}
