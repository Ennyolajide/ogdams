<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Enny Olajide',
            'email' => 'eniseyinolajide@gmail.com',
            'password' => bcrypt('secret'),
            'api_token' => Str::random(60),
            'role' => 'admin',
            'permission' => true,
            'active' => true,
            'number' => '07063637002',
            'address' => 'no 13 ifelodun',
            'city' => 'abeokuta',
            'state' => 'ogun',
            'wallet_id' => 'A1b2C3D4xyz112',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Test Man',
            'email' => 'a@a.com',
            'password' => bcrypt('secret'),
            'api_token' => Str::random(60),
            'active' => true,
            'number' => '08000000000',
            'balance' => 10000,
            'city' => 'Moon',
            'state' => 'Universe',
            'referrer' => 'A1b2C3D4xyz112',
            'wallet_id' => Str::random('8') . rand(1, 100) . Str::random(2),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
