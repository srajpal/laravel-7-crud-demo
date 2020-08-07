<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password')
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'email' => 'admin2@admin.com',
            'password' => Hash::make('password')
        ]);
    }
}
