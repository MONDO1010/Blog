<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin Zute',
            'email' => 'admin@zute.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Create regular test user
        User::create([
            'name' => 'Utilisateur Test',
            'email' => 'user@zute.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);
    }
}
