<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Админ',
            'slug' => 'admin',
        ]);

        $role->users()->attach(1);

        $role = Role::create([
            'name' => 'Пользователь',
            'slug' => 'user',
        ]);

        $role->users()->attach(2);
    }
}
