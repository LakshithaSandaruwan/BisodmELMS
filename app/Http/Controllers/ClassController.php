<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use Illuminate\Http\Request;
use App\Models\SubjectMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    //
    public function ViewClasses()
    {

        $classes = DB::table('subject_mappings')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('teachers', 'subject_mappings.teacher_id', '=', 'teachers.id')
            ->join('batches', 'subject_mappings.batchId', '=', 'batches.id')
            ->select(
                'subject_mappings.*',
                'grades.Grade as grade_name',
                'subjects.subject_name as subject_name',
                'teachers.full_name as teacher_name',
                'batches.Year as batch_name'
            )
            ->where('subject_mappings.IsEnd', false)
            ->where('subject_mappings.teacher_id', 1)
            ->get();
        return view('Teacher.OngoingClasses', compact('classes'));
    }

    public function savehomework(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|integer',
            'file' => 'required|file|mimes:pdf,docx,ppt|max:2048',
            'deadline' => 'required|date'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('homeworks', 'public');

            $homework = new Homework();
            $homework->subject_id = $request->input('subject_id');
            $homework->file_path = $filePath;
            $homework->deadline = $request->input('deadline');
            $homework->save();

            return redirect()->back()->with('success', 'Homework saved successfully.');
        }

        return redirect()->back()->with('error', 'There was an issue saving the homework.');
    }

    public function ViewHomeworks()
    {
        // $teacherId = Auth::id();
        $teacherId = 1;
        $currentDate = now();
        // $homeworks = DB::table('homework')
        //     ->join('subject_mappings', 'homework.subject_id', '=', 'subject_mappings.id')
        //     ->where('subject_mappings.teacher_id', $teacherId)
        //     ->where('subject_mappings.IsEnd', false)
        //     ->select('homework.*', 'subject_mappings.subject_id as mapped_subject_id', 'subject_mappings.grade_id', 'subject_mappings.teacher_id')
        //     ->get();

        $homeworks = DB::table('homework')
            ->join('subject_mappings', 'homework.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->join('batches', 'subject_mappings.batchId', '=', 'batches.id')
            ->where('subject_mappings.teacher_id', $teacherId)
            ->where('homework.deadline', '>=', $currentDate)
            ->select(
                'homework.*',
                'subjects.subject_name as subject_name',
                'grades.Grade as grade_name',
                'batches.Year as batch_name'
            )
            ->get();


        return view('Teacher.Homework', compact('homeworks'));
    }
}
