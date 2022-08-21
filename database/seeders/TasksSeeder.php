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
        Task::create([
            'name' => 'Задание 1',
            'description' => 'Описание задания 1',
            'flag' => 'GUMRF{flag1}',
            'url' => 'https://www.google.com',
            'price' => 500,
        ]);
    }
}
