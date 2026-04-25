<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gutural.com'],
            [
                'name'     => 'Admin Gutural',
                'password' => Hash::make('gutural2024'),
                'is_admin' => true,
            ]
        );
    }
}
