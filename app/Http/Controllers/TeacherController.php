<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TeacherPayment;
use App\Mail\TeacherSalaryMail;
use App\Mail\TeacherPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rules\Unique;

class TeacherController extends Controller
{
    //
    public function Register(Request $request)
    {
        $request->validate([
            'teacher_initial' => 'required|string|max:255',
            'teacher_Lastname' => 'required|string|max:255',
            'teacher_fullname' => 'required|string|max:255',
            'teacher_gender' => 'required|string|in:Male,Female',
            'teacher_birthday' => 'required|date',
            'T_NIC' => 'required|string|max:10', // Adjust max length as per your needs
            'study_qulification' => 'required|string|max:255',
            'T_number' => 'required|string|max:10',
            'T_housenumber' => 'required|string|max:255',
            'T_streetaddress' => 'required|string|max:255',
            'T_district' => 'required|string|max:255',
            'T_province' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'T_NIC'=> 'required|unique:teachers,nic'
        ]);

        $randomPassword = Str::random(12);

        $user = new User();
        $user->name = $request->input('teacher_Lastname');
        $user->email = $request->input('email');
        $user->email_verified_at = Carbon::now();
        $user->password = Hash::make($randomPassword);
        $user->user_role = 2;
        $user->save();

        $teacher = new Teacher();
        $teacher->initial = $request->input('teacher_initial');
        $teacher->lastname = $request->input('teacher_Lastname');
        $teacher->full_name = $request->input('teacher_fullname');
        $teacher->gender = $request->input('teacher_gender');
        $teacher->birthdate = $request->input('teacher_birthday');
        $teacher->nic = $request->input('T_NIC');
        $teacher->study_qulification = $request->input('study_qulification');
        $teacher->contact = $request->input('T_number');
        $teacher->email = $request->input('email');
        $teacher->houseNumber = $request->input('T_housenumber');
        $teacher->street = $request->input('T_streetaddress');
        $teacher->district = $request->input('T_district');
        $teacher->province = $request->input('T_province');
        $teacher->user_id = $user->id;

        $teacher->save();

        Mail::to($user->email)->send(new TeacherPasswordEmail($user->name, $randomPassword));

        return redirect()->back()->with('success', 'Teacher registered successfully!');
    }

    public function showTeacherStudentCount($teacherId)
    {
        $teacher = Teacher::findOrFail($teacherId);
        $totalStudents = $teacher->calculateTotalStudents();

        $gross = $totalStudents * 250;
        $insitutePay = $gross * 20 / 100;

        return view('Admin.SalaryUpdate', compact('gross', 'insitutePay', 'teacherId'));
    }

    public function AllTeachers()
    {
        $teachers = Teacher::all();

        $teachers = Teacher::with(['subjectMappings.enrollments.payments', 'payments'])->get();

        foreach ($teachers as $teacher) {
            $teacher->total_students = $teacher->calculateTotalStudents();
            $teacher->has_payments = $teacher->hasPayments();
        }


        return view('Admin.AllTeachers', compact('teachers'));
    }

    public function TeacherSalary()
    {
        $teachers = Teacher::all();

        $teachers = Teacher::with(['subjectMappings.enrollments.payments', 'payments'])->get();

        foreach ($teachers as $teacher) {
            $teacher->total_students = $teacher->calculateTotalStudents();
            $teacher->has_payments = $teacher->hasPayments();
        }


        return view('Admin.Salaries', compact('teachers'));
    }

    public function SalaryPay(Request $request, PDF $pdf)
    {
        $validator = Validator::make($request->all(), [
            'teacherId' => 'required|exists:teachers,id',
            'gross' => 'required|numeric',
            'bonus' => 'required|numeric',
            'insitutepay' => 'required|numeric',
            'tax' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Save teacher payment
        $payment = new TeacherPayment();
        $payment->teacher_id = $request->teacherId;
        $payment->month = Carbon::now();
        $payment->basic = $request->gross;
        $payment->bonus = $request->bonus;
        $payment->insitute_pay = $request->insitutepay;
        $payment->taxes = $request->tax;
        $payment->save();

        // Fetch teacher and prepare salary details
        $teacher = Teacher::findOrFail($request->teacherId);
        $salaryDetails = [
            'month' => Carbon::now()->format('F Y'),
            'basic' => $request->gross,
            'bonus' => $request->bonus,
            'insitute_pay' => $request->insitutepay,
            'taxes' => $request->tax,
            'total' => $request->gross + $request->bonus + $request->insitutepay - $request->tax,
        ];

        // Send email with PDF attachment
        Mail::to($teacher->email)->send(new TeacherSalaryMail($teacher, $salaryDetails, $pdf));

        return redirect()->route('allteachers');
    }

    public function filterTeachers(Request $request)
    {
        $query = $request->get('query');
        $teachers = Teacher::where('full_name', 'LIKE', "%{$query}%")
        ->orWhere('nic','LIKE',"%{$query}%")
        ->get();

        return response()->json($teachers);
    }

    public function generatePDF()
    {
        $teachers = Teacher::all(); // Fetch the students or pass it from wherever necessary

        $pdf = PDF::loadView('pdf.teacher', compact('teachers'));

        return $pdf->download('teacher.pdf'); // Download the generated PDF
    }
}
