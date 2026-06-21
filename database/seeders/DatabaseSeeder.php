<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed default Admin
        User::factory()->create([
            'name' => 'Admin Vora',
            'email' => 'admin@vora.ai',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Seed default User
        User::factory()->create([
            'name' => 'User Vora',
            'email' => 'user@vora.ai',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Seed some random users
        User::factory(18)->create();
    }
}
