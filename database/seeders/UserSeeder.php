<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'Administrator';
        $user->last_name = 'Administrator';
        $user->phone = '3246763454';
        $user->identification = '1012564345';
        $user->address = 'calle 10';
        $user->city = 'Bogota';
        $user->department = 'Cundinamarca';
        $user->email = 'administrator@gmail.com';
        $user->password = bcrypt('1234');
        $user->role = 'Jefe';
        $user->save();


        $user = new User();
        $user->name = 'Carlos';
        $user->last_name = 'Bernal Gomez';
        $user->phone = '3246763654';
        $user->identification = '1012564665';
        $user->address = 'calle 10';
        $user->city = 'Bogota';
        $user->department = 'Cundinamarca';
        $user->email = 'carlosbernal@gmail.com';
        $user->password = bcrypt('1234');
        $user->role = 'Colaborador';
        $user->save();
    }
}
