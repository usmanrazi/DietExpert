<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'username' => 'admin',
            'email' => 'admin@beeppanel.com',
            'password' => bcrypt('secret'),
            'role' => 1,
        ]);
    }
}
