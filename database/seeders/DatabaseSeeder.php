<?php

namespace Database\Seeders;

use App\Models\student;
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
        // User::factory(10)->create();
        student::insert([
            ['student_code' => 'S001', 'full_name' => 'أحمد الخطيب',  'card_uid' => 'A1B2C3D4', 'created_at' => now(), 'updated_at' => now()],
            ['student_code' => 'S002', 'full_name' => 'ليلى الحسن',   'card_uid' => 'B2C3D4E5', 'created_at' => now(), 'updated_at' => now()],
            ['student_code' => 'S003', 'full_name' => 'عمر السيد',    'card_uid' => 'C3D4E5F6', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
