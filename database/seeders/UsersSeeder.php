<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Админ',
            'surname' => 'Админов',
            'patronymic' => 'Админович',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
        ]);

        User::create([
            'name' => 'Пользователь',
            'surname' => 'Пользователев',
            'patronymic' => 'Пользователевич',
            'group' => 'ИБ-51',
            'email' => 'user@mail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
