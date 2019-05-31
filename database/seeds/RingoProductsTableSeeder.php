<?php

use Illuminate\Database\Seeder;

class RingoProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        /* $table->string('product_id');
        $table->string('services');
        $table->integer('min_amount');
        $table->integer('max_amount'); */

        /**
         * Electricity
         */
        DB::table('ringo_products')->insert([
            'name' => 'Eko PHCN',
            'product_id' => 'BPE-NGEK-OR',
            'service' => 'Electricity',
            'service_id' => 'electricity',
            'min_amount' => 50,
            'max_amount' => 50000,
            'validation' => true,
            'logo' => 'electricity/ekedc.png',
            'route' => 'electricity.ekedc'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Ikeja Electric',
            'product_id' => 'BPE-NGIE-OR',
            'service' => 'Electricity',
            'service_id' => 'electricity',
            'min_amount' => 500,
            'max_amount' => 50000,
            'validation' => true,
            'logo' => 'electricity/ikedc.png',
            'route' => 'electricity.ikedc'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Ibadan Distribution',
            'product_id' => 'BPE-NGIB-OR',
            'service' => 'Electricity',
            'service_id' => 'electricity',
            'min_amount' => 1000,
            'max_amount' => 50000,
            'validation' => true,
            'logo' => 'electricity/ibedc.png',
            'route' => 'electricity.ibedc'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Enugu Distribution',
            'product_id' => 'BPE-NGEN-OR',
            'service' => 'Electricity',
            'service_id' => 'electricity',
            'min_amount' => 1000,
            'max_amount' => 50000,
            'validation' => true,
            'logo' => 'electricity/eedc.png',
            'route' => 'electricity.eedc'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Port Harcourt Prepaid',
            'product_id' => 'BPE-NGCABIA-OR',
            'service' => 'Electricity',
            'service_id' => 'electricity',
            'min_amount' => 1000,
            'max_amount' => 50000,
            'validation' => true,
            'logo' => 'electricity/phedc.png',
            'route' => 'electricity.phedc.prepaid'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Port Harcourt Postpaid',
            'product_id' => 'BPE-NGCABIB-OR',
            'service' => 'Electricity',
            'service_id' => 'electricity',
            'min_amount' => 1000,
            'max_amount' => 50000,
            'validation' => true,
            'logo' => 'electricity/phedc.png',
            'route' => 'electricity.phedc.postpaid'
        ]);

        /**
         * Tv
         */
        DB::table('ringo_products')->insert([
            'name' => 'DSTV',
            'product_id' => 'BPD-NGCA-AQA',
            'service' => 'Tv',
            'service_id' => 'dstv',
            'validation' => true,
            'multichoice' => true,
            'product_list' => true,
            'logo' => 'tv/dstv.jpg',
            'route' => 'tv.dstv'

        ]);

        DB::table('ringo_products')->insert([
            'name' => 'GOTV',
            'product_id' => 'BPD-NGCA-AQC',
            'service' => 'Tv',
            'service_id' => 'dstv',
            'validation' => true,
            'multichoice' => true,
            'product_list' => true,
            'logo' => 'tv/gotv.jpg',
            'route' => 'tv/gotv'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'STARTIMES',
            'product_id' => 'BPD-NGCA-AWA',
            'service' => 'Tv',
            'service_id' => 'dstv',
            'min_amount' => 1000,
            'max_amount' => 50000,
            'multichoice' => true,
            'validation' => true,
            'logo' => 'tv/startimes.png',
            'route' => 'tv/startimes'
        ]);

        /**
         * Internet
         */
        DB::table('ringo_products')->insert([
            'name' => 'SpectraNet',
            'product_id' => 'BPI-NGCA-BGA',
            'service' => 'Internet',
            'service_id' => 'internet',
            'multichoice' => true,
            'product_list' => true,
            'status' => false,
            'logo' => 'internet/spectranet.png',
            'route' => 'internet/spectranet'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Smile Recharge',
            'product_id' => 'BPI-NGCA-ANA',
            'service' => 'Internet',
            'service_id' => 'internet',
            'min_amount' => 100,
            'max_amount' => 50000,
            'multichoice' => true,
            'logo' => 'internet/smile.png',
            'route' => 'internet/smile.recharge'
        ]);

        DB::table('ringo_products')->insert([
            'name' => 'Smile Bundles',
            'product_id' => 'BPI-NGCA-ANB',
            'service' => 'Internet',
            'service_id' => 'internet',
            'multichoice' => true,
            'product_list' => true,
            'logo' => 'internet/smile.png',
            'route' => 'internet/smile.bundles'
        ]);

        /**
         * Misc
         */
        DB::table('ringo_products')->insert([
            'name' => 'WAEC',
            'product_id' => 'BPM-NGCA-ASA',
            'service' => 'Misc',
            'service_id' => 'misc',
            'multichoice' => true,
            'product_list' => true,
            'logo' => 'misc/waec.png',
            'route' => 'internet/waec'
        ]);
    }
}
