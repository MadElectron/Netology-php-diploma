<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            'title' => 'Опубликован',
        ]);
        DB::table('statuses')->insert([
            'title' => 'Ожидает ответа',
        ]);
        DB::table('statuses')->insert([
            'title' => 'Скрыт',
        ]);
    }
}
