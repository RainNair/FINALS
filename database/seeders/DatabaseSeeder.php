<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'theespi116@gmail.com'], [
            'name' => 'Restaurant Administrator',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::updateOrCreate(['email' => 'user@example.com'], [
            'name' => 'Restaurant Customer',
            'password' => 'password',
            'role' => 'user',
        ]);
    }
}
