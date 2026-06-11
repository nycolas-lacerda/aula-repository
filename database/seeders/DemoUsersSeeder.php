<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = User::firstOrCreate(
            ['email' => 'professor@escola.local'],
            [
                'name' => 'Professor Demo',
                'password' => Hash::make('12345678'),
            ]
        );

        $teacher->assignRole('teacher');

        $coordinator = User::firstOrCreate(
            ['email' => 'coordenador@escola.local'],
            [
                'name' => 'Coordenador Demo',
                'password' => Hash::make('12345678'),
            ]
        );

        $coordinator->assignRole('coordinator');
    }
}
