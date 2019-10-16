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
            //'api_token' => Str::random(60),
            'role' => 'admin',
            'permission' => true,
            'active' => true,
            'number' => '07063637002',
            'address' => 'no 13 ifelodun',
            'city' => 'abeokuta',
            'state' => 'ogun',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'wallet_id' => strtoupper(Str::random('2')) . rand(1, 100) . strtoupper(Str::random(2)),
        ]);

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'support@ogdams.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'permission' => true,
            'active' => true,
            'number' => '09066685702',
            'address' => 'no 13 ifelodun',
            'city' => 'abeokuta',
            'state' => 'ogun',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'wallet_id' => 'OGDAMS',
        ]);

        DB::table('users')->insert([
            'name' => 'Test Man',
            'email' => 'a@a.com',
            'password' => bcrypt('secret'),
            //'api_token' => Str::random(60),
            'active' => true,
            'number' => '08000000000',
            'balance' => 10000,
            'city' => 'Moon',
            'state' => 'Universe',
            'referrer' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'wallet_id' => strtoupper(Str::random('2')) . rand(1, 100) . strtoupper(Str::random(2)),
        ]);
    }
}
