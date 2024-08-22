<?php

namespace App\Http\Controllers;

use App\Models\Batch;
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

    public function DeleteSubject($id){
        $subject= Subject::find($id);
        if($subject){
            $subject->delete();
            return redirect()->back()->with('success','Subject deleted successfully.');
        }else{
            return redirect()->back()->with('error','Subject not found');
        }
    }

    public function SubjectEdit(Request $request){

        $request->validate([
            'subject'=>'required|string|max:255'
        ]);

        $subject = Subject::find($request->Subid);
        if($subject){
            $subject->subject_name = $request->input('subject');
            $subject->save();
            return redirect()->back()->with('success','Subject update succesfully');
        }else{
            return redirect()->back()->with('error','Subject not found');
        }
    }

    

    public function SubjectMapping()
    {
        $subjects = Subject::all();
        $grades = Grade::all();
        $teachers = Teacher::all();
        $batches = Batch::where('IsStillEnrolling', true)->get();

        return view('Admin.SubjectMapping', compact('subjects', 'grades', 'teachers', 'batches'));
    }

    public function SaveSubjectMapping(Request $request)
    {
        $request->validate([
            'batch' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'Teacher' => 'required|string|max:255'
        ]);
        // Exist subjet view message 
        $existingMapping = SubjectMapping::where('grade_id', $request->input('grade'))
            ->where('subject_id', $request->input('subject'))
            ->where('batchId', $request->input('batch'))
            ->first();

        if ($existingMapping) {
            return redirect()->back()->with('error', 'The combination already exists!');
        }
        // Exist subject view message end
        $subjectmappings = new SubjectMapping();
        $subjectmappings->grade_id = $request->input('grade');
        $subjectmappings->subject_id = $request->input('subject');
        $subjectmappings->teacher_id = $request->input('Teacher');
        $subjectmappings->batchId = $request->input('batch');
        $subjectmappings->save();

        return redirect()->back()->with('success', 'Subject mapping successfully!');
    }

    public function filter(Request $request)
    {
        $gradeId = $request->input('grade_id');
        $batchId = $request->input('batch_id');

        $subjectMappings = DB::table('subject_mappings')
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
            ->where('grades.id', $gradeId)
            ->where('batches.id', $batchId)
            ->where('subject_mappings.IsEnd', false)
            ->get();

        return response()->json($subjectMappings);
    }

    public function EndTheClass($id)
    {
        $Class = SubjectMapping::find($id);

        if ($Class) {
            $Class->IsEnd = true;
            $Class->save();

            $batchDetail = SubjectMapping::where('batchId', $Class->batchId)
                ->where('IsEnd', false)->get();

            if ($batchDetail->count() == 0) {
                $batch = Batch::find($Class->batchId);
                $batch->IsStillEnrolling = false;
                $batch->save();
            }

            return redirect()->back()->with('success', 'Class ended successfully');
        } else {
            return redirect()->back()->with('error', 'something went wrong');
        }
    }
}
