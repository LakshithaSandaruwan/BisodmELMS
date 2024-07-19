<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\HomeworkSubmition;
use Illuminate\Http\Request;
use App\Models\SubjectMapping;
use App\Models\ZoomLink;
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

        $homeworks = Homework::select('homework.*', 'subjects.subject_name as subject_name', 'grades.Grade as grade_name', 'batches.Year as batch_name')
            ->join('subject_mappings', 'homework.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->join('batches', 'subject_mappings.batchId', '=', 'batches.id')
            ->where('subject_mappings.teacher_id', $teacherId)
            ->where('homework.deadline', '>=', $currentDate)
            ->withCount('submissions') // Add this to get the count of submissions
            ->get();

        return view('Teacher.Homework', compact('homeworks'));
    }

    public function ViewHomeworkSubmisions($id)
    {
        $homeworkSubmisions = DB::table('homework_submitions')
            ->join('students', 'homework_submitions.student_id', '=', 'students.id')
            ->select(
                'homework_submitions.Submision_file_path as filename',
                'homework_submitions.results as results',
                'homework_submitions.id as id',
                'students.FullName as full_name',
                'students.id as stId'
            )
            ->where('homework_submitions.homework_id', $id)
            ->get();

        return view('Teacher.ViewSubmision', compact('homeworkSubmisions'));
    }

    public function AddResults(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:homework_submitions,id',
            'Results' => 'required|string'
        ]);

        $submission = HomeworkSubmition::findOrFail($request->input('id'));

        // Update the results column
        $submission->results = $request->input('Results');
        $submission->save();

        return redirect()->back()->with('success', 'Results updated successfully');
    }

    public function Savelink(Request $request){
        $request->validate([
            'subject_id' => 'required|integer',
            'link' => 'required|string',
            'Day' => 'required|string',
            'stime' => 'required',
            'etime' => 'required',
        ]);

        $zoomlink = new ZoomLink();
        $zoomlink->Links = $request->input('link');
        $zoomlink->subject_id = $request->input('subject_id');
        $zoomlink->day = $request->input('Day');
        $zoomlink->StartTime = $request->input('stime');
        $zoomlink->EndTime = $request->input('etime');
        $zoomlink->save();

        return redirect()->back()->with('success', 'Zoom link updated successfully');
    }
}
