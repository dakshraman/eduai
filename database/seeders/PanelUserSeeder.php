<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ParentModel;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PanelUserSeeder extends Seeder
{
    public function run(): void
    {
        $schoolId = 1;

        // --- Account Admin (school-level admin, separate from the platform superadmin) ---
        User::firstOrCreate(
            ['email' => 'accountadmin@eduai.com'],
            [
                'name' => 'Account Admin',
                'password' => Hash::make('password'),
                'school_id' => $schoolId,
                'role' => 'admin',
                'active_status' => true,
            ]
        );

        // Ensure a demo class + section + subject exist
        $class = ClassModel::firstOrCreate(
            ['school_id' => $schoolId, 'name' => 'Grade 10'],
            ['name_numeric' => 10, 'section_count' => 2, 'active_status' => true]
        );

        $section = Section::firstOrCreate(
            ['school_id' => $schoolId, 'class_id' => $class->id, 'name' => 'A'],
            ['active_status' => true]
        );

        $subject = Subject::firstOrCreate(
            ['school_id' => $schoolId, 'class_id' => $class->id, 'name' => 'Mathematics'],
            ['subject_code' => 'MATH10', 'pass_mark' => 33, 'full_mark' => 100, 'active_status' => true]
        );

        // --- Teacher ---
        $teacherUser = User::firstOrCreate(
            ['email' => 'teacher@eduai.com'],
            [
                'name' => 'Demo Teacher',
                'password' => Hash::make('password'),
                'school_id' => $schoolId,
                'role' => 'teacher',
                'active_status' => true,
            ]
        );

        Teacher::firstOrCreate(
            ['user_id' => $teacherUser->id],
            [
                'school_id' => $schoolId,
                'employee_id' => 'EMP-1001',
                'designation' => 'Senior Teacher',
                'department' => 'Science',
                'joining_date' => now()->subYear(),
                'active_status' => true,
            ]
        );

        // --- Student ---
        $studentUser = User::firstOrCreate(
            ['email' => 'student@eduai.com'],
            [
                'name' => 'Demo Student',
                'password' => Hash::make('password'),
                'school_id' => $schoolId,
                'role' => 'student',
                'active_status' => true,
            ]
        );

        $student = Student::firstOrCreate(
            ['user_id' => $studentUser->id],
            [
                'school_id' => $schoolId,
                'class_id' => $class->id,
                'section_id' => $section->id,
                'admission_number' => 'ADM-2024-0001',
                'roll_number' => 1,
                'admission_date' => now()->subYear(),
                'session_year' => now()->year,
                'active_status' => true,
            ]
        );

        // --- Parent ---
        $parentUser = User::firstOrCreate(
            ['email' => 'parent@eduai.com'],
            [
                'name' => 'Demo Parent',
                'password' => Hash::make('password'),
                'school_id' => $schoolId,
                'role' => 'parent',
                'active_status' => true,
            ]
        );

        $parent = ParentModel::firstOrCreate(
            ['user_id' => $parentUser->id],
            [
                'school_id' => $schoolId,
                'occupation' => 'Engineer',
                'relation_type' => 'father',
                'phone' => '+1-555-0101',
                'address' => '456 Parent Lane, Knowledge City',
            ]
        );

        $parent->students()->syncWithoutDetaching([$student->id]);

        // --- Demo data so the panels show something ---
        if (Attendance::where('student_id', $student->id)->count() === 0) {
            foreach (range(1, 20) as $day) {
                $status = $day % 5 === 0 ? 'absent' : ($day % 7 === 0 ? 'late' : 'present');
                Attendance::create([
                    'school_id' => $schoolId,
                    'student_id' => $student->id,
                    'class_id' => $class->id,
                    'section_id' => $section->id,
                    'date' => now()->subDays($day)->toDateString(),
                    'status' => $status,
                ]);
            }
        }

        $exam = Exam::firstOrCreate(
            ['school_id' => $schoolId, 'name' => 'Midterm Examination 2026'],
            [
                'class_id' => $class->id,
                'start_date' => now()->subDays(10)->toDateString(),
                'end_date' => now()->subDays(5)->toDateString(),
                'exam_type' => 'midterm',
                'active_status' => true,
            ]
        );

        ExamResult::firstOrCreate(
            ['exam_id' => $exam->id, 'student_id' => $student->id, 'subject_id' => $subject->id],
            [
                'school_id' => $schoolId,
                'marks_obtained' => 85,
                'remarks' => 'Excellent work!',
            ]
        );
    }
}