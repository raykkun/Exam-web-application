<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\User;
use App\Models\ClassUser;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classrooms = [
            ['name' => 'Class 10A', 'code' => '10A', 'description' => 'Grade 10 Class A'],
            ['name' => 'Class 10B', 'code' => '10B', 'description' => 'Grade 10 Class B'],
            ['name' => 'Class 11A', 'code' => '11A', 'description' => 'Grade 11 Class A'],
            ['name' => 'Class 11B', 'code' => '11B', 'description' => 'Grade 11 Class B'],
            ['name' => 'Class 12A', 'code' => '12A', 'description' => 'Grade 12 Class A'],
            ['name' => 'Class 12B', 'code' => '12B', 'description' => 'Grade 12 Class B'],
        ];

        foreach ($classrooms as $classroom) {
            Classroom::create($classroom);
        }

        // Assign students to classrooms
        $students = User::where('role', 'student')->get();
        $classroomIds = Classroom::pluck('id')->toArray();

        foreach ($students as $index => $student) {
            $classroomId = $classroomIds[$index % count($classroomIds)];
            ClassUser::create([
                'user_id' => $student->id,
                'classroom_id' => $classroomId,
            ]);
        }
    }
}