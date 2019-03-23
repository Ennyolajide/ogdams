<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //Voucher Seeder
        factory(App\Voucher::class, 20)->create();

        //Message Seeder
        factory(App\Message::class, 20)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(DataPlansTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(PaymentGatewaysTableSeeder::class);
        $this->call(AirtimePercentagesTableSeeder::class);
        $this->call(CoinsTableSeeder::class);
    }
}
