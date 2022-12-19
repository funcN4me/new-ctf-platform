<?php

namespace Database\Seeders;

use App\Models\Resource;
use Faker\Factory;
use Faker\Provider\ru_RU\Text;
use Illuminate\Database\Seeder;

class ResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++) {
            Resource::create([
                'name' => Factory::create()->name,
                'description' => Factory::create()->text,
            ]);
        }
    }
}
