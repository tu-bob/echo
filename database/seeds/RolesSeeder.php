<?php

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
        collect([
            'admin' => 'Администратор',
            'teacher' => 'Учитель',
            'librarian' => 'Библиотекарь',
            'staff' => 'Сотрудник',
            'student' => 'Студент'
        ])->each(function ($local_name, $name) {
            Role::create(['name' => $name, 'local_name' => $local_name]);
        });
    }
}
