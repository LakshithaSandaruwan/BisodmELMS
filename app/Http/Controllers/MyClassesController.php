<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyClassesController extends Controller
{
    //
    public function ViewClasses()
    {
        $studentId = 1;

        $homeworkDetails = Enrollment::join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
            ->join('homework', 'subject_mappings.id', '=', 'homework.subject_id')
            ->leftJoin('homework_submitions', function ($join) use ($studentId) {
                $join->on('homework.id', '=', 'homework_submitions.homework_id')
                     ->where('homework_submitions.student_id', '=', $studentId);
            })
            ->where('enrollments.student_id', $studentId)
            ->distinct()
            ->select(
                'homework.id as homework_id',
                'homework.file_path',
                'homework.deadline',
                'homework_submitions.Submision_file_path as submission_file_path',
                'homework_submitions.created_at as submission_date'
            )
            ->get();

        dd($homeworkDetails);

        return view('Student.MyClass', compact('homeworkDetails'));
    }
}
