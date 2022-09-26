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
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(SubcategoriesSeeder::class);
        $this->call(TasksSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
