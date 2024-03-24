<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if (User::count() === 0) {
            \App\Models\User::factory()->create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'is_admin' => true,
            ]);
            \App\Models\User::factory()->create([
                'name' => 'user',
                'email' => 'user@user.com',
                'is_admin' => false,
                'subscription_end_date' => now()->addDays(10),
            ]);
        }

        $this->call([
            UserSeeder::class,
        ]);
    }
}
