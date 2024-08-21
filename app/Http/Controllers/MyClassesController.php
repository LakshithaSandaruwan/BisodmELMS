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

    public function Calander()
    {
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $timetables = DB::table('enrollments as e')
            ->join('subject_mappings as sm', 'e.subject_id', '=', 'sm.id')
            ->join('subjects as s', 'sm.subject_id', '=', 's.id')
            ->join('zoom_links as zl', 'sm.id', '=', 'zl.subject_id')
            ->join('teachers','sm.teacher_id','=','teachers.id')
            ->join('grades','sm.grade_id','=','grades.id')
            ->select(
                's.subject_name',
                'zl.Links as zoom_link',
                'zl.day',
                'zl.StartTime',
                'zl.EndTime',
                'teachers.full_name',
                'grades.Grade',
                'sm.id as subId'
            )
            ->where('e.student_id', $studentId)
            ->get();

            // dd($timetables);
        return view('Student.Calander', compact('timetables'));
    }
}
