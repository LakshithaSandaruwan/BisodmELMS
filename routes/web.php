<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\MyClassesController;
use App\Http\Controllers\EnrollmentController;
use App\Models\StudentPayment;
use App\Models\SubjectMapping;

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
})->name('Student.Registration');

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



//teacher


//student


Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/admin', function () {
        return view('Admin.Dashboard');
    });

    Route::get('/teacherregistration', function () {
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

    Route::get('/teacherStudent/{id}', [TeacherController::class, 'showTeacherStudentCount']);

    Route::get('/allteachers', [TeacherController::class, 'AllTeachers'])->name('allteachers');

    Route::get('/teacherSalaries', [TeacherController::class, 'TeacherSalary'])->name('teacherSalaries');

    Route::get('/allstudents', [StudentController::class, 'AllStudents'])->name('AllStudents');

    Route::post('/salarypayment', [TeacherController::class, 'SalaryPay']);

    Route::get('/admin/backup', [BackupController::class, 'createBackup'])->name('admin.backup');

    Route::get('/filter-teachers', [TeacherController::class, 'filterTeachers'])->name('filter.teachers');

    Route::get('/filter-students', [StudentController::class, 'filterStudents'])->name('filter.students');

    Route::get('/deleteGrade/{id}', [GradeController::class, 'delete'])->name('delete.grade');

    Route::post('/updateGrade/{id}', [GradeController::class, 'update'])->name('update.grade');

    Route::get('/students/pdf', [StudentController::class, 'generatePDF'])->name('students.pdf');

    Route::get('/teachers/pdf', [TeacherController::class, 'generatePDF'])->name('students.pdf');

    Route::get('/student-payments', [PaymentController::class, 'ViewStudentsPayments'])->name('AllStudentPayments');

    Route::get('/get-payments', [PaymentController::class, 'getPayments'])->name('get.payments');

    Route::post('/PrintStudentPayments', [PaymentController::class, 'PrintStudentPayments'])->name('StudentPaymentsPrint');
    
    Route::get('/teacher-payments', [PaymentController::class, 'ViewTeachersPayments'])->name('AllTeacherPayments');

    Route::get('/get-Teacher-payments', [PaymentController::class, 'getTeachersPayments'])->name('get.teacherspayments');

    Route::post('/PrintTeacherPayments', [PaymentController::class, 'PrintTeachersPayments'])->name('TeacherPaymentsPrint');
});

Route::middleware(['auth', 'Teacher'])->group(function () {
    Route::get('/ongoingclasses', [ClassController::class, 'ViewClasses']);

    Route::post('/savehomeworks', [ClassController::class, 'savehomework']);

    Route::get('/homeworks', [ClassController::class, 'ViewHomeworks']);

    Route::get('/viewhomeworksubmision/{id}', [ClassController::class, 'ViewHomeworkSubmisions']);

    Route::post('/AddResults', [ClassController::class, 'AddResults']);

    Route::post('/savelink', [ClassController::class, 'Savelink']);

    Route::post('/savequiz', [QuizController::class, 'SubmitQuiz']);

    Route::post('/save-question', [QuizController::class, 'saveQuestion'])->name('saveQuestion');

    Route::get('/add-questions/{quizid}', [QuizController::class, 'AddQuestions'])->name('add-questions');

    Route::get('/BatchStudents/{id}', [StudentController::class, 'BatchStudents']);

    Route::get('/ViewZoomLinks', [ClassController::class, 'ViewLinks']);

    Route::get('/RemoveHomework/{id}', [ClassController::class, 'RemoveHomework']);

    Route::get('/endClass/{id}', [SubjectController::class, 'EndTheClass']);
    
    Route::get('/ViewQuizes', [QuizController::class, 'viewQuizes']);
    
});

Route::middleware(['auth', 'Student'])->group(function () {
    Route::get('/student', function () {
        return view('Student.Dashboard');
    });

    Route::get('/enrollment', [EnrollmentController::class, 'ViewNewEnrolment'])->name('view-enrollment');

    Route::get('/subjects-by-grade/{gradeId}/{batchId}', [EnrollmentController::class, 'getSubjectsByGrade']);

    Route::post('/saveenrolment', [EnrollmentController::class, 'SaveEnrolment']);

    Route::get('/myhomeworks', [MyClassesController::class, 'MyHomeWorks']);

    Route::get('/MyCalander', [MyClassesController::class, 'Calander']);

    Route::post('/submithomework', [ClassController::class, 'SubmitHomeworks']);

    Route::get('/take-quiz', [QuizController::class, 'MyQuiz']);

    Route::get('/view-quiz-questions/{id}', [QuizController::class, 'ViewQuizQuestions'])->name('view-questions');

    Route::post('/submit-quiz', [QuizController::class, 'SubmitQuizAnswers']);

    Route::get('/payment/{id}', [PaymentController::class, 'UpdatePayments'])->name('update.payment');
    
});



//payments
Route::get('/payment/page/{id}', [PaymentController::class, 'handlePayment'])->name('payment.handle');
Route::post('/payment/success', [PaymentController::class, 'paymentSuccess']);
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel']);
Route::post('/payment/notify', [PaymentController::class, 'paymentNotify']);
