<?php

use Illuminate\Database\Seeder;

class RingoSubProductListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        /**
         * Dstv
         */
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'COMPLE36',
            'name' => 'DStv Compact Plus',
            'ringo_price' => 10437,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'PRWE36',
            'name' => 'DStv Premium',
            'ringo_price' => 15484,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'PRWASIE36',
            'name' => 'DStv Premium Asia',
            'ringo_price' => 17346,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'ASIAE36',
            'name' => 'Asian Bouqet',
            'ringo_price' => 5292,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'FTAE36',
            'name' => 'DStv FTA Plus',
            'ringo_price' => 1568,
            'ringo_product_id' => 7
        ]);
        /**
         * End of Dstv
         */

        /**
         * Gotv
         */
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOTV',
            'name' => 'GOtv Value',
            'ringo_price' => 1225,
            'ringo_product_id' => 8

        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOTVPLS',
            'name' => 'GOtv Plus',
            'ringo_price' => 1862,
            'ringo_product_id' => 8
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOtvMax',
            'name' => 'GOtv Max',
            'ringo_price' => 3136,
            'ringo_product_id' => 8
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOHAN',
            'name' => 'GOtv Lite Monthly',
            'ringo_price' => 392,
            'ringo_product_id' => 8
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOLITE',
            'name' => 'GOtv Lite Quarterly',
            'ringo_price' => 1029,
            'ringo_product_id' => 8
        ]);


        /**
         * End of Gotv
         */


        /**
         * Smile Bundles
         */

        DB::table('ringo_sub_product_lists')->insert([
            'code' => '356',
            'name' => 'FlexiDaily plan',
            'ringo_price' => 487.5,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '495',
            'name' => 'SmileVoice ONLY 75',
            'ringo_price' => 487.5,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '413',
            'name' => '2GB MidNite Plan',
            'ringo_price' => 975,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '220',
            'name' => '1GB SmileLite plan',
            'ringo_price' => 975,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '496',
            'name' => 'SmileVoice ONLY 165',
            'ringo_price' => 975,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '357',
            'name' => 'FlexiWeekly plan',
            'ringo_price' => 1170,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '414',
            'name' => '3GB MidNite Plan',
            'ringo_price' => 1462.5,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '415',
            'name' => '3GB Weekend Only Plan',
            'ringo_price' => 1462.5,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '280',
            'name' => '2GB SmileLite plan',
            'ringo_price' => 1950,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '102',
            'name' => '3GB Anytime plan',
            'ringo_price' => 2925,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '497',
            'name' => 'SmileVoice ONLY 500',
            'ringo_price' => 2925,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '150',
            'name' => '5GB Anytime plan',
            'ringo_price' => 3900,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '274',
            'name' => '7GB Anytime plan',
            'ringo_price' => 4875,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '404',
            'name' => '10GB 30 Days Anytime plan',
            'ringo_price' => 7312,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '103',
            'name' => '10GB Anytime plan',
            'ringo_price' => 8775,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '273',
            'name' => '15GB Anytime plan',
            'ringo_price' => 9750,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '476',
            'name' => 'Unlimited Lite Plan',
            'ringo_price' => 9750,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '358',
            'name' => '30GB BumpaValue plan',
            'ringo_price' => 14625,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '104',
            'name' => '20GB Anytime plan',
            'ringo_price' => 16575,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '475',
            'name' => 'Unlimited Premium Plan',
            'ringo_price' => 19305,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '359',
            'name' => '60GB BumpaValue plan',
            'ringo_price' => 29250,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '105',
            'name' => '50GB Anytime plan',
            'ringo_price' => 35100,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '360',
            'name' => '80GB BumpaValue plan',
            'ringo_price' => 48750,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '128',
            'name' => '100GB Anytime plan',
            'ringo_price' => 68250,
            'ringo_product_id' => 11
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '129',
            'name' => '200GB Anytime plan',
            'ringo_price' => 131625,
            'ringo_product_id' => 11
        ]);
        /**
         * End of Smile Bundles
         */

        /**
         * Misc
         */

        DB::table('ringo_sub_product_lists')->insert([
            'code' => '700',
            'name' => 'N700 PIN',
            'ringo_price' => 700,
            'ringo_product_id' => 13
        ]);
    }
}
