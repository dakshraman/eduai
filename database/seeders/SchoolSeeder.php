<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        School::firstOrCreate(
            ['id' => 1],
            [
                'name' => 'EduAI Demo School',
                'slug' => 'demo',
                'code' => 'DEMO',
                'address' => '123 Education Street, Knowledge City',
                'phone' => '+1-555-0100',
                'email' => 'info@eduai-demo.com',
                'active_status' => true,
            ]
        );
    }
}
