<?php

use Carbon\Carbon;
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
            'role' => 'admin',
            'active' => true,
            'number' => '07063637002',
            'address' => 'no 13 ifelodun',
            'city' => 'abeokuta',
            'state' => 'ogun',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('users')->insert([
            'name' => 'Test Man',
            'email' => 'a@a.com',
            'password' => bcrypt('secret'),
            'active' => true,
            'number' => '08000000000',
            'city' => 'Moon',
            'state' => 'Universe',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
