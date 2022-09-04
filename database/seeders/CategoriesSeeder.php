<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Web',
        ]);

        Category::create([
            'name' => 'Reverse',
        ]);

        Category::create([
            'name' => 'Forensics',
        ]);

        Category::create([
            'name' => 'Crypto',
        ]);

        Category::create([
            'name' => 'Misc',
        ]);
    }
}
