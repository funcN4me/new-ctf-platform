<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            Task::create([
                'name' => 'Задание ' . $i,
                'description' => 'Описание задания ' . $i,
                'flag' => 'GUMRF{flag' . $i . '}',
                'url' => 'https://google.com',
                'price' => $i * 100,
                'category_id' => rand(1, 5),
                'subcategory' => 'Подкатегория ' . $i,
            ]);
        }

        Task::create([
            'name' => 'Задание 6',
            'description' => 'Описание задания 6',
            'flag' => 'GUMRF{flag6}',
            'price' => 1000,
            'category_id' => 1,
            'subcategory' => 'Подкатегория 6',
        ]);
    }
}
