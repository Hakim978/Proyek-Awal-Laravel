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
        $adminPassword = config('inventory.admin_password');

        if (blank($adminPassword)) {
            return;
        }

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Administrator', 'password' => $adminPassword],
        );
    }
}
