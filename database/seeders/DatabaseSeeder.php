<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $panelUserRole = Role::where('name', 'panel_user')->first();

        if (!$panelUserRole) {
            $panelUserRole = Role::create(['name' => 'panel_user']);
        }

        // Create a new user
        $user1 = User::factory()->create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => '@user123',
        ]);

        $user1->assignRole($panelUserRole);

    }
}
