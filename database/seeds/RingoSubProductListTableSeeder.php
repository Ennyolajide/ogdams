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
        /**
         * Dstv
         */
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'ACSSE36',
            'name' => 'DStv Access',
            'ringo_price' => 1960,
            'selling_price' => 2000,
            'ringo_product_id' => 7
        ]);

        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'COFAME36',
            'name' => 'DStv Family',
            'ringo_price' => 3920,
            'selling_price' => 4000,
            'ringo_product_id' => 7
        ]);

        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'COMPE36',
            'name' => 'DStv Compact',
            'ringo_price' => 6664,
            'selling_price' => 7000,
            'ringo_product_id' => 7
        ]);

        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'COMPLE36',
            'name' => 'DStv Compact Plus',
            'ringo_price' => 10437,
            'selling_price' => 11000,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'PRWE36',
            'name' => 'DStv Premium',
            'ringo_price' => 15484,
            'selling_price' => 16000,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'PRWASIE36',
            'name' => 'DStv Premium Asia',
            'ringo_price' => 17346,
            'selling_price' => 18000,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'ASIAE36',
            'name' => 'Asian Bouqet',
            'ringo_price' => 5292,
            'selling_price' => 5500,
            'ringo_product_id' => 7
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'FTAE36',
            'name' => 'DStv FTA Plus',
            'ringo_price' => 1568,
            'selling_price' => 1800,
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
            'selling_price' => 1300,
            'ringo_product_id' => 8

        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOTVPLS',
            'name' => 'GOtv Plus',
            'ringo_price' => 1862,
            'selling_price' => 1900,
            'ringo_product_id' => 8
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOtvMax',
            'name' => 'GOtv Max',
            'ringo_price' => 3136,
            'selling_price' => 3200,
            'ringo_product_id' => 8
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOHAN',
            'name' => 'GOtv Lite Monthly',
            'ringo_price' => 392,
            'selling_price' => 500,
            'ringo_product_id' => 8
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => 'GOLITE',
            'name' => 'GOtv Lite Quarterly',
            'ringo_price' => 1029,
            'selling_price' => 1200,
            'ringo_product_id' => 8
        ]);


        /**
         * End of Gotv
         */

        /**
         * Startimes
         */
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '60',
            'name' => 'Nova - One day',
            'ringo_price' => 60,
            'selling_price' => 60,
            'group' => 'Nova',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '300',
            'name' => 'Nova - One Week',
            'ringo_price' => 300,
            'selling_price' => 300,
            'group' => 'Nova',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '900',
            'name' => 'Nova - One Month',
            'ringo_price' => 900,
            'selling_price' => 900,
            'group' => 'Nova',
            'ringo_product_id' => 9
        ]);
        //Basic
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '90',
            'name' => 'Basic - One Day',
            'ringo_price' => 90,
            'selling_price' => 90,
            'group' => 'Basic',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '450',
            'name' => 'Basic - One Week',
            'ringo_price' => 450,
            'selling_price' => 450,
            'group' => 'Basic',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '1300',
            'name' => 'Basic - One Month',
            'ringo_price' => 1300,
            'selling_price' => 1300,
            'group' => 'Basic',
            'ringo_product_id' => 9
        ]);
        //Smart
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '120',
            'name' => 'Smart - One Day',
            'ringo_price' => 120,
            'selling_price' => 120,
            'group' => 'Smart',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '600',
            'name' => 'Smart - One Week',
            'ringo_price' => 600,
            'selling_price' => 600,
            'group' => 'Smart',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '1900',
            'name' => 'Smart - One Month',
            'ringo_price' => 1900,
            'selling_price' => 1900,
            'group' => 'Smart',
            'ringo_product_id' => 9
        ]);
        //Classic
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '180',
            'name' => 'Classic - One Day',
            'ringo_price' => 180,
            'selling_price' => 180,
            'group' => 'Classic',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '900',
            'name' => 'Classic - One Week',
            'ringo_price' => 900,
            'selling_price' => 900,
            'group' => 'Classic',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '2600',
            'name' => 'Classic - One Month',
            'ringo_price' => 2600,
            'selling_price' => 2600,
            'group' => 'Classic',
            'ringo_product_id' => 9
        ]);
        //Super
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '240',
            'name' => 'Super - One Day',
            'ringo_price' => 240,
            'selling_price' => 240,
            'group' => 'Super',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '1300',
            'name' => 'Super - One Week',
            'ringo_price' => 1200,
            'selling_price' => 1200,
            'group' => 'Super',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '3800',
            'name' => 'Super - One Month',
            'ringo_price' => 3800,
            'selling_price' => 3800,
            'group' => 'Super',
            'ringo_product_id' => 9
        ]);
        //Unique
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '240',
            'name' => 'Unique - One Day',
            'ringo_price' => 240,
            'selling_price' => 240,
            'group' => 'Unique',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '1300',
            'name' => 'Unique - One Week',
            'ringo_price' => 1300,
            'selling_price' => 1300,
            'group' => 'Unique',
            'ringo_product_id' => 9
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '3000',
            'name' => 'Unique - One Month',
            'ringo_price' => 3000,
            'selling_price' => 3000,
            'group' => 'Unique',
            'ringo_product_id' => 9
        ]);
        /**
         * End of Startimes
         */

        /**
         * Spectranet
         */

        DB::table('ringo_sub_product_lists')->insert([
            'code' => '500',
            'name' => 'N500 PIN',
            'ringo_price' => 485,
            'ringo_product_id' => 10
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '1000',
            'name' => 'N1000 PIN',
            'ringo_price' => 970,
            'ringo_product_id' => 10
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '2000',
            'name' => 'N1000 PIN',
            'ringo_price' => 1940,
            'ringo_product_id' => 10
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '5000',
            'name' => 'N5000 PIN',
            'ringo_price' => 4850,
            'ringo_product_id' => 10
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '7000',
            'name' => 'N7000 PIN',
            'ringo_price' => 6790,
            'ringo_product_id' => 10
        ]);

        /**
         * End of Spectranet
         */


        /**
         * Smile Bundles
         */

        DB::table('ringo_sub_product_lists')->insert([
            'code' => '356',
            'name' => 'FlexiDaily plan',
            'ringo_price' => 487.5,
            'selling_price' => 500,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '495',
            'name' => 'SmileVoice ONLY 75',
            'ringo_price' => 487.5,
            'selling_price' => 500,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '413',
            'name' => '2GB MidNite Plan',
            'ringo_price' => 975,
            'selling_price' => 1000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '220',
            'name' => '1GB SmileLite plan',
            'ringo_price' => 975,
            'selling_price' => 1000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '496',
            'name' => 'SmileVoice ONLY 165',
            'ringo_price' => 975,
            'selling_price' => 1000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '357',
            'name' => 'FlexiWeekly plan',
            'ringo_price' => 1170,
            'selling_price' => 1200,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '414',
            'name' => '3GB MidNite Plan',
            'ringo_price' => 1462.5,
            'selling_price' => 1500,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '415',
            'name' => '3GB Weekend Only Plan',
            'ringo_price' => 1462.5,
            'selling_price' => 1500,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '280',
            'name' => '2GB SmileLite plan',
            'ringo_price' => 1950,
            'selling_price' => 2000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '102',
            'name' => '3GB Anytime plan',
            'ringo_price' => 2925,
            'selling_price' => 3000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '497',
            'name' => 'SmileVoice ONLY 500',
            'ringo_price' => 2925,
            'selling_price' => 3000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '150',
            'name' => '5GB Anytime plan',
            'ringo_price' => 3900,
            'selling_price' => 4000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '274',
            'name' => '7GB Anytime plan',
            'ringo_price' => 4875,
            'selling_price' => 6000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '404',
            'name' => '10GB 30 Days Anytime plan',
            'ringo_price' => 7312,
            'selling_price' => 7500,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '103',
            'name' => '10GB Anytime plan',
            'ringo_price' => 8775,
            'selling_price' => 9000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '273',
            'name' => '15GB Anytime plan',
            'ringo_price' => 9750,
            'selling_price' => 10000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '476',
            'name' => 'Unlimited Lite Plan',
            'ringo_price' => 9750,
            'selling_price' => 10000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '358',
            'name' => '30GB BumpaValue plan',
            'ringo_price' => 14625,
            'selling_price' => 15000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '104',
            'name' => '20GB Anytime plan',
            'ringo_price' => 16575,
            'selling_price' => 17000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '475',
            'name' => 'Unlimited Premium Plan',
            'ringo_price' => 19305,
            'selling_price' => 20000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '359',
            'name' => '60GB BumpaValue plan',
            'ringo_price' => 29250,
            'selling_price' => 30000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '105',
            'name' => '50GB Anytime plan',
            'ringo_price' => 35100,
            'selling_price' => 36000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '360',
            'name' => '80GB BumpaValue plan',
            'ringo_price' => 48750,
            'selling_price' => 50000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '128',
            'name' => '100GB Anytime plan',
            'ringo_price' => 68250,
            'selling_price' => 70000,
            'ringo_product_id' => 12
        ]);
        DB::table('ringo_sub_product_lists')->insert([
            'code' => '129',
            'name' => '200GB Anytime plan',
            'ringo_price' => 131625,
            'selling_price' => 135000,
            'ringo_product_id' => 12
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
            'selling_price' => 700,
            'ringo_product_id' => 13
        ]);
    }
}
