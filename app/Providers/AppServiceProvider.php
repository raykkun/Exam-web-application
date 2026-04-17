<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view::composer('components.navbar', function ($view){
            $role = auth()->user()?->role;

            $menu = match($role){
                'admin' => [
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                    ['label' => 'Manage Classroom', 'url' => route('classrooms.index')],
                    ['label' => 'Manage Subjects', 'url' => route('subjects.index')],
                    ['label' => 'Manage Exams', 'url' => route('exams.index')],
                    // ['label' => 'Manage Questions', 'url' => route('questions.index')],
                    // ['label' => 'Manage Participants', 'url' => route('participants.index')],
                    // ['label' => 'View Results', 'url' => route('results.index')],
                ],
                'teacher' => [
                    ['label' => 'Dashboard', 'url' => route('teacher.dashboard')],
                    ['label' => 'My Classrooms', 'url' => route('teacher.classrooms')],
                    ['label' => 'My Subjects', 'url' => route('teacher.subjects')],

                    // Part Exam management for teachers
                    ['label' => 'My Exams', 'url' => route('teacher.exams.index')],
                    // ['label' => 'Results', 'url' => route('teacher.results')],
                ],
                'student' => [
                    ['label' => 'Dashboard', 'url' => route('student.dashboard')],
                    ['label' => 'My Exams', 'url' => route('student.exams')],
                    ['label' => 'My Results', 'url' => route('student.results')],
                ],
                default => [
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                ]
            };

            $view->with('navMenu', $menu);
        });
    }
}
