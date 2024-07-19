<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Models\SubjectMapping;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    //
    public function ViewNewEnrolment()
    {
        $batches = Batch::where('IsStillEnrolling', true)->get();
        $grades = Grade::all();

        return view('Student.Enrolling', compact('batches', 'grades'));
    }

    public function getSubjectsByGrade($gradeId, $batchid)
    {
        $subjects = SubjectMapping::where('grade_id', $gradeId)->get();

        $subjects = DB::table('subject_mappings')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->select(
                'subject_mappings.*',
                'subjects.subject_name as subject_name'
            )
            ->where('subject_mappings.grade_id', $gradeId)
            ->where('subject_mappings.batchId', $batchid)
            ->where('subject_mappings.IsEnd', false)
            ->get();

        return response()->json($subjects);
    }

    public function SaveEnrolment(Request $request){
        $request->validate([
            'subject' => 'required'
        ]);

        $enrolment = new Enrollment();
        $enrolment->subject_id = $request->input('subject');
        $enrolment->student_id = 1;
        $enrolment->save();

        return redirect()->back()->with('success', 'Enrolment successfully!');
    }
}
