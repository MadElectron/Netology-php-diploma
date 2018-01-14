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
            'name' => 'admin',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('admin'),
            'is_admin' => 1,
            'created_at' => new \Datetime(),
            'updated_at' => new \Datetime(),
        ]);
    }
}
