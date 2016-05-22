<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'sdu_id' => '1',
            'email' => str_random(10).'admin@mail.com',
            'password' => bcrypt('1234'),
            'type' => 'admin',
            'avatar' => 'assets/images/avatars/05.png',
            'firstname' => 'Admin',
            'lastname' => 'Demo',
        ]);
    }
}
