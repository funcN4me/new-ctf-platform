<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create([
            'name' => 'XSS',
        ]);

        Subcategory::create([
            'name' => 'XXE',
        ]);

        Subcategory::create([
            'name' => 'SQLi',
        ]);

        Subcategory::create([
            'name' => 'LFI',
        ]);

        Subcategory::create([
            'name' => 'RCE',
        ]);

        Subcategory::create([
            'name' => 'Buffer overflow',
        ]);

        Subcategory::create([
            'name' => 'Format string',
        ]);

        Subcategory::create([
            'name' => 'Malware',
        ]);
    }
}
