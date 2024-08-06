<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Carbon\Carbon;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\StudentPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userData = Auth::user();
        if ($userData->user_role == 1) {
            $teachers = Teacher::count();
            $students = Student::count();

            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $startOfLastMonth = Carbon::now()->subMonth()->startOfMonth();
            $endOfLastMonth = Carbon::now()->subMonth()->endOfMonth();

            $totalAmountforCorrentMonth = StudentPayment::whereBetween('payment_date', [$startOfMonth, $endOfMonth])
                ->sum('amount');

            $totalAmount = StudentPayment::sum('amount');

            $currentMonthData = Student::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('COUNT(id) as count')
            )
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->groupBy('day')
                ->pluck('count', 'day')
                ->toArray();

            $lastMonthData = Student::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('COUNT(id) as count')
            )
                ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                ->groupBy('day')
                ->pluck('count', 'day')
                ->toArray();

            $currentMonthTeachersData = Teacher::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('COUNT(id) as count')
            )
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->groupBy('day')
                ->pluck('count', 'day')
                ->toArray();

            $lastMonthTeachersData = Teacher::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('COUNT(id) as count')
            )
                ->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])
                ->groupBy('day')
                ->pluck('count', 'day')
                ->toArray();

            $popularSubjects = DB::table('enrollments')
                ->join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
                ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
                ->select('subjects.subject_name', DB::raw('count(enrollments.id) as enrollment_count'))
                ->groupBy('subjects.subject_name')
                ->orderBy('enrollment_count', 'desc')
                ->get();

            return view('Admin.Dashboard', compact('currentMonthTeachersData', 'lastMonthTeachersData', 'teachers', 'students', 'totalAmountforCorrentMonth', 'totalAmount', 'currentMonthData', 'lastMonthData', 'popularSubjects'));
        } else if ($userData->user_role == 2) {
            return view('Teacher.Dashboard');
        } else if ($userData->user_role == 3) {

            $authId = Auth::id();
            $student = Student::where('user_id', $authId)->first();

            if ($student) {
                $studentId = $student->id;

                $results = DB::table('enrollments as e')
                    ->join('subject_mappings as sm', 'e.subject_id', '=', 'sm.id')
                    ->join('subjects as s', 'sm.subject_id', '=', 's.id')
                    ->join('homework as hw', 'sm.id', '=', 'hw.subject_id')
                    ->join('homework_submitions as hs', function ($join) use ($studentId) {
                        $join->on('e.student_id', '=', 'hs.student_id')
                            ->on('hs.subject_id', '=', 'sm.id');
                    })
                    ->select(
                        'hs.id as submission_id',
                        'hs.Submision_file_path',
                        'hw.file_path as homework_file_path',
                        'hw.deadline',
                        'hs.results',
                        's.subject_name',
                        'sm.grade_id',
                        'sm.teacher_id'
                    )
                    ->where('e.student_id', $studentId)
                    ->where('hs.results', '!=', 'pending')
                    ->get();

                $enrollcount = Enrollment::where('student_id', $studentId)->count();

                $currentDate = Carbon::now();

                $upcomingDeadlines = Enrollment::join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
                    ->join('homework', 'subject_mappings.id', '=', 'homework.subject_id')
                    ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
                    ->leftJoin('homework_submitions', function ($join) use ($studentId) {
                        $join->on('homework.id', '=', 'homework_submitions.homework_id')
                            ->where('homework_submitions.student_id', '=', $studentId);
                    })
                    ->where('enrollments.student_id', $studentId)
                    ->where('homework.deadline', '>', $currentDate)
                    ->distinct()
                    ->select(
                        'homework.id as homework_id',
                        'homework.subject_id as subject_id',
                        'homework.file_path',
                        'homework.deadline',
                        'homework_submitions.Submision_file_path as submission_file_path',
                        'homework_submitions.created_at as submission_date',
                        'homework_submitions.results',
                        'subjects.subject_name'
                    )
                    ->get();

                return view('Student.Dashboard', compact('results', 'enrollcount', 'upcomingDeadlines'));
            } else {
                return redirect()->route('home')->with('error', 'Student not found.');
            }
        } else {
            return view('welcome');
        }
    }
}
