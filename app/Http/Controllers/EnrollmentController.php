<?php

namespace App\Http\Controllers;

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
        $enrolment->save();

        $student = Student::where('user_id', $userId)->first();

        $merchant_id = '1227290'; // Replace with your Merchant ID
        $order_id = $studentId; // Replace with dynamic order ID
        $amount = 250; // Replace with dynamic amount
        $currency = 'LKR';
        $merchant_secret = 'MzgyMTk2ODQzODM4MzcxNjQyNDUyMjUxODI5NjY2MTkwOTY4NDk0Mw=='; // Replace with your Merchant Secret

        // Generate the hash
        $hash = strtoupper(
            md5(
                $merchant_id . 
                $order_id . 
                number_format($amount, 2, '.', '') . 
                $currency .  
                strtoupper(md5($merchant_secret)) 
            ) 
        );

        // Customer details (you may get these from the request or session)
        $customer = [
            'first_name' => $student->FullName,
            'last_name' => $student->FullName,
            'email' => $student->email,
            'phone' => $student->contactNumber,
            'address' => $student->street,
            'city' => $student->city,
            'country' => 'Sri Lanka'
        ];

        // Payment details
        $paymentDetails = [
            'merchant_id' => $merchant_id,
            'order_id' => $order_id,
            'items' => 'Class Fees', // Replace with dynamic item description
            'currency' => $currency,
            'amount' => $amount,
            'first_name' => $customer['first_name'],
            'last_name' => $customer['last_name'],
            'email' => $customer['email'],
            'phone' => $customer['phone'],
            'address' => $customer['address'],
            'city' => $customer['city'],
            'country' => $customer['country'],
            'hash' => $hash,
            'return_url' => 'http://127.0.0.1:8000/enrollment/'.$enrolment->id, 
            'cancel_url' => 'http://sample.com/cancel', 
            'notify_url' => 'http://sample.com/notify'  
        ];

        return view('payment.payhere', compact('paymentDetails'));
    }
}
