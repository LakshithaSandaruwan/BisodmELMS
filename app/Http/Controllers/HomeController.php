<?php

namespace App\Http\Controllers;

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
            return view('Student.Dashboard');
        } else {
            return view('welcome');
        }
    }
}
