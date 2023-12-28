<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [ 'name' => 'admin1', 'email' => 'admin1@test.com', 'password' => \Hash::make('123456') ],
            [ 'name' => 'admin2', 'email' => 'admin2@test.com', 'password' => \Hash::make('123456') ],
            [ 'name' => 'admin3', 'email' => 'admin3@test.com', 'password' => \Hash::make('123456') ],
        ]);
    }
}
