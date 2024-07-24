<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyClassesController extends Controller
{
    //
    public function MyHomeWorks()
    {
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $homeworkDetails = Enrollment::join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
            ->join('homework', 'subject_mappings.id', '=', 'homework.subject_id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->leftJoin('homework_submitions', function ($join) use ($studentId) {
                $join->on('homework.id', '=', 'homework_submitions.homework_id')
                     ->where('homework_submitions.student_id', '=', $studentId);
            })
            ->where('enrollments.student_id', $studentId)
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

        return view('Student.MyClass', compact('homeworkDetails'));
    }
}
