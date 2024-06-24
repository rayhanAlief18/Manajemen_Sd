<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('1234'), // Hashing password
            'level' => "admin",
        ]);

        User::create([
            'name' => 'Guru',
            'email' => 'guru@guru.com',
            'password' => Hash::make('1234'), // Hashing password
            'level' => "guru",
        ]);
    }
}
