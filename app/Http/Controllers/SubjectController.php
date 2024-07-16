<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\SubjectMapping;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    //
    public function Save(Request $request)
    {
        $request->validate([
            'subjectname' => 'required|string|max:255'
        ]);

        $subject = new Subject();
        $subject->subject_name = $request->input('subjectname');
        $subject->save();

        return redirect()->back()->with('success', 'Subject registered successfully!');
    }

    public function View()
    {
        $subjects = Subject::all();
        return view('Admin.NewSubject', compact('subjects'));
    }

    public function SubjectMapping()
    {
        $subjects = Subject::all();
        $grades = Grade::all();
        $teachers = Teacher::all();

        return view('Admin.SubjectMapping', compact('subjects', 'grades', 'teachers'));
    }

    public function SaveSubjectMapping(Request $request)
    {
        $request->validate([
            'grade' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'Teacher' => 'required|string|max:255'
        ]);

        $subjectmappings = new SubjectMapping();
        $subjectmappings->grade_id = $request->input('grade');
        $subjectmappings->subject_id = $request->input('subject');
        $subjectmappings->teacher_id = $request->input('Teacher');
        $subjectmappings->save();

        return redirect()->back()->with('success', 'Subject mapping successfully!');
    }

    public function filter(Request $request)
    {
        $gradeId = $request->input('grade_id');

        $subjectMappings = DB::table('subject_mappings')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('teachers', 'subject_mappings.teacher_id', '=', 'teachers.id')
            ->select('subject_mappings.*', 'grades.Grade as grade_name', 'subjects.subject_name as subject_name', 'teachers.full_name as teacher_name')
            ->where('grades.id', $gradeId)
            ->get();

        return response()->json($subjectMappings);
    }
}
