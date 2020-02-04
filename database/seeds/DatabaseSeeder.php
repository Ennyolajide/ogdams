<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //Message Seeder
        //factory(App\Message::class, 50)->create();

        //Tansaction Seeder
        //factory(App\Transaction::class, 5)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        //factory(App\Bank::class, 5)->create();
        $this->call(ChargesTableSeeder::class);
        $this->call(DataPlansTableSeeder::class); //First time Run

        $this->call(BulkSmsConfigsTableSeeder::class); //first time run

        $this->call(PaymentGatewaysTableSeeder::class); //First time Run
        $this->call(AirtimePercentagesTableSeeder::class); //First time Run

        $this->call(RingoProductsTableSeeder::class); //First time Run
        $this->call(RingoSubProductListTableSeeder::class); //First time Run
    }
}
