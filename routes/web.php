<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\RoleMiddleware;


// Route::get('login', [AuthController::class, 'index']) -> name('login') -> middleware('guest');
// Route::post('login', [AuthController::class, 'authenticate']);
 Route::get('/home', function () {
        return view('home');
    })->name('home');
// Route::middleware(['guest'])->group(function () {
//     Route::get('/', [AuthController::class, 'index']);  

//     Route::get('login', [AuthController::class, 'index'])->name('login');
//     Route::post('login', [AuthController::class, 'authenticate']);
    
   
// });


// Route::post('logout', [AuthController::class, 'logout'])->name('logout');



// Route::middleware(['auth', 'role:teacher'])->group(function () {
//     Route::get('teacher/dashboard', function () {
//         return view('teacher.dashboard');
//     })->name('teacher.dashboard');
//     // Route::get('/', [AuthController::class, 'index']);  
// });

// Route::middleware(['auth', 'role:student'])->group(function () {
//     Route::get('student/dashboard', function () {
//         return view('student.dashboard');
//     })->name('student.dashboard');
//     // Route::get('/', [AuthController::class, 'index']);  
// });





// Route::middleware('auth')->group(function () {
    
// });

// /*
// |--------------------------------------------------------------------------
// | Public Routes
// |--------------------------------------------------------------------------
// */

// // Route::get('/', function () {
// //     return view('welcome');
// // });

// /*
// |--------------------------------------------------------------------------
// | Authentication Routes (Laravel Breeze)
// |--------------------------------------------------------------------------
// */

require __DIR__.'/auth.php';

// /*
// |--------------------------------------------------------------------------
// | Authenticated Routes
// |--------------------------------------------------------------------------
// */

Route::middleware(['auth'])->group(function () {

//     /*
//     |--------------------------------------------------------------------------
//     | Dashboard (Redirect by Role)
//     |--------------------------------------------------------------------------
//     */
//     Route::get('/', [AuthController::class, 'dashboard'])
//         ->name('dashboard');

//     /*
//     |--------------------------------------------------------------------------
//     | Profile
//     |--------------------------------------------------------------------------
//     */
//     Route::get('/profile', function () {
//         return view('profile.index');
//     })->name('profile');

//     /*
//     |--------------------------------------------------------------------------
//     | Admin Routes
//     |--------------------------------------------------------------------------
//     */
// Route::middleware(['auth', 'role:admin'])->group(function () {
    
    
// });
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        Route::resource('classrooms', ClassroomController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('exams', ExamController::class);
        // Route::resource('questions', QuestionController::class);
        // Route::resource('participants', ParticipantController::class);
        // Route::get('/results', [ResultController::class, 'index'])->name('results.index');

        Route::resource('admin/users', UserController::class, ['as' => 'admin']);

    });

//     /*
//     |--------------------------------------------------------------------------
//     | Guru Routes
//     |--------------------------------------------------------------------------
//     */
    Route::middleware(['role:teacher'])->group(function () {
        Route::get('/teacher/dashboard', [DashboardController::class, 'teacher'])->name('teacher.dashboard');

        Route::get('/my-classrooms', function () {
            return view('teacher.classrooms');
        })->name('teacher.classrooms');

        Route::get('/my-subjects', function () {
            return view('teacher.subjects.index');
        })->name('teacher.subjects');

        Route::resource('teacher/exams', ExamController::class, ['as' => 'teacher']);
       
        Route::resource('teacher/questions', QuestionController::class, ['as' => 'teacher']);
        // Route::resource('Exams', ExamController::class);
        
    });
//     Route::middleware(['role:guru'])->group(function () {

//         Route::resource('questions', QuestionController::class);
//         Route::resource('exams', ExamController::class);

//         Route::get('/exams/{exam}/results', [ResultController::class, 'index'])
//             ->name('exams.results');

//     });

//     /*
//     |--------------------------------------------------------------------------
//     | Siswa Routes
//     |--------------------------------------------------------------------------
//     */
    Route::middleware(['role:student'])->group(function () {
        
        Route::get('student/dashboard', [DashboardController::class, 'student'])
            ->name('student.dashboard');
    
        Route::get('student/profile', [StudentProfileController::class, 'show'])
            ->name('student.profile.show');
        Route::get('student/profile/edit', [StudentProfileController::class, 'edit'])
            ->name('student.profile.edit');
        Route::put('student/profile', [StudentProfileController::class, 'update'])
            ->name('student.profile.update');
        Route::delete('student/profile/avatar', [StudentProfileController::class, 'destroyAvatar'])
            ->name('student.profile.avatar.destroy');

        Route::get('student/exams', [ExamController::class, 'myExams'])
            ->name('student.exams');

        Route::get('student/exams/{exam}', [ExamController::class, 'showExam'])
            ->name('student.exam.show');

        Route::get('student/exams/{exam}/start', [ExamController::class, 'startExam'])
            ->name('student.exam.start');

        Route::post('student/exams/{exam}/submit', [ExamController::class, 'submitExam'])
            ->name('student.exam.submit');

        Route::get('student/results', [ExamController::class, 'myResults'])
            ->name('student.results');

        Route::get('student/results/{result}', [ExamController::class, 'showResult'])
            ->name('student.result.show');

    });

//     /*
//     |--------------------------------------------------------------------------
//     | Pimpinan Routes
//     |--------------------------------------------------------------------------
//     */
//     Route::middleware(['role:pimpinan'])->group(function () {

//         Route::get('/reports', [ResultController::class, 'reports'])
//             ->name('reports.index');

//     });

});
