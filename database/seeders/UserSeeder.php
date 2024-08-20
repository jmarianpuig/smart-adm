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
        // Crear un usuario Super Admin
        $superAdmin = User::create([
            'name' => 'Jose Maria',
            'first_lname' => 'Navarro',
            'second_lname' => 'Puig',
            'full_name' => 'Jose Maria Navarro Puig',
            'email' => 'jmarianpuig@gmail.com',
            'phone' => '617149606',
            'password' => bcrypt('12345678'),
        ]);

        // Asignar el rol "Super Admin" al usuario
        // $superAdmin->assignRole('Super');
    }
}
