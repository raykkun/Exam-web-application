<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudentProfile;

class StudentProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'student')->get();

        foreach ($students as $student) {
            StudentProfile::create([
                'user_id' => $student->id,
                'phone' => '+62' . rand(800000000, 899999999),
                'date_of_birth' => now()->subYears(rand(16, 25))->subDays(rand(0, 365)),
                'address' => 'Jl. Example No. ' . rand(1, 100) . ', Jakarta',
                'emergency_contact_name' => 'Parent ' . $student->name,
                'emergency_contact_phone' => '+62' . rand(800000000, 899999999),
                'bio' => 'I am a dedicated student passionate about learning and achieving my goals.',
            ]);
        }
    }
}
