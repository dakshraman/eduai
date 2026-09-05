<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@eduai.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'school_id' => 1,
                'role' => 'super_admin',
                'active_status' => true,
            ]
        );
    }
}
