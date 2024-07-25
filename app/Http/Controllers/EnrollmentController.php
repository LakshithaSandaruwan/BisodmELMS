<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Batch;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\SubjectMapping;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    //
    public function ViewNewEnrolment()
    {
        // $studentId = Auth::id();
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $batches = Batch::where('IsStillEnrolling', true)->get();
        $grades = Grade::all();

        $enrolmentDetails = Enrollment::join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->leftJoin('zoom_links', 'subject_mappings.id', '=', 'zoom_links.subject_id')
            ->where('enrollments.student_id', $studentId)
            ->select(
                'subjects.subject_name',
                'zoom_links.Links as zoom_link',
                'zoom_links.day as day',
                'zoom_links.StartTime as stime',
                'zoom_links.EndTime as etime',
                'enrollments.*',
                DB::raw('DATEDIFF(enrollments.Next_Payment_Date, CURDATE()) as days_remaining')
            )
            ->get();


        // dd($enrolmentDetails);

        return view('Student.Enrolling', compact('batches', 'grades', 'enrolmentDetails'));
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

    public function SaveEnrolment(Request $request)
    {
        $request->validate([
            'subject' => 'required'
        ]);

        $subjectId = $request->input('subject');
        // $studentId = Auth::id();
        $userId = Auth::id();
        $studentId = Student::where('user_id', $userId)->pluck('id')->first();

        $enrolmentDetails = Enrollment::where('subject_id', $subjectId)
            ->where('student_id', $studentId)
            ->get();

        // dd($enrolmentDetails);

        if ($enrolmentDetails->count() > 0) {
            return redirect()->back()->with('error', 'You have already enrolled to this subject!');
        }

        $enrolment = new Enrollment();
        $enrolment->subject_id = $request->input('subject');
        $enrolment->student_id = $studentId ;
        $enrolment->Next_Payment_Date = Carbon::now();
        $enrolment->save();

        return redirect()->route('payment.handle', ['id' => $enrolment->id]);
    }
}
