<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student-registration', function () {
    return view('StudentRegistration');
});

Route::get('/teacher-registration', function () {
    return view('TeacherRegistration');
});

//student routes
Route::post('/SaveStudent', [StudentController::class, 'Register']);

//teacher routes
Route::post('/teacherRegistration', [TeacherController::class, 'Register']);



Auth::routes();
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//admin
Route::get('/admin', function () {
    return view('Admin.Dashboard');
});

Route::get('/teacher', function () {
    return view('Admin.Teacher');
});

Route::get('/subject', [SubjectController::class, 'View']);

Route::post('/savesubject', [SubjectController::class, 'Save']);

Route::get('/grades', [GradeController::class, 'View']);

Route::post('/savegrade', [GradeController::class, 'Save']);

Route::get('/setsubjects', [SubjectController::class, 'SubjectMapping']);

Route::post('/subjectmapping', [SubjectController::class, 'SaveSubjectMapping']);

Route::get('/subject-mappings/filter', [SubjectController::class, 'filter'])->name('subject-mappings.filter');

Route::get('/batch', [BatchController::class, 'view']);

Route::post('/savebatch', [BatchController::class, 'Save']);


//teacher
Route::get('/teacher', function () {
    return view('Teacher.Dashboard');
});

Route::get('/ongoingclasses', [ClassController::class, 'ViewClasses']);

Route::post('/savehomeworks', [ClassController::class, 'savehomework']);

Route::get('/homeworks', [ClassController::class, 'ViewHomeworks']);

Route::get('/viewhomeworksubmision/{id}', [ClassController::class, 'ViewHomeworkSubmisions']);

Route::post('/AddResults', [ClassController::class, 'AddResults']);

Route::post('/savelink', [ClassController::class, 'Savelink']);

//student
Route::get('/student', function () {
    return view('Student.Dashboard');
});

Route::get('/enrollment', [EnrollmentController::class, 'ViewNewEnrolment']);

Route::get('/subjects-by-grade/{gradeId}/{batchId}', [EnrollmentController::class, 'getSubjectsByGrade']);

Route::post('/saveenrolment', [EnrollmentController::class, 'SaveEnrolment']);


