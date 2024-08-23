<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\StudentPayment;
use Illuminate\Support\Facades\DB;


class PaymentController extends Controller
{
    public function handlePayment($id)
    {
        $request = Enrollment::where('id', $id)->first();
        $student = Student::where('id', $request->student_id)->first();


        $merchant_id = env('PAYHERE_MERCHANT_ID');
        $return_url = url('/payment/success');
        $cancel_url = url('/payment/cancel');
        $notify_url = url('/payment/notify');

        $order_id = $request->id;
        $items = 'monthly class fees';
        $currency = 'LKR';
        $amount = 250;
        $first_name = $student->initial;
        $last_name = $student->FullName;
        $email = $student->email;
        $phone = $student->contactNumber;
        $address = $student->houseNumber . '' . $student->street . '' . $student->district;
        $city = $student->district;
        $country = 'Sri Lanka';

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5(env('PAYHERE_SECRET')))
            )
        );

        $payment_data = [
            'merchant_id' => $merchant_id,
            'return_url' => $return_url,
            'cancel_url' => $cancel_url,
            'notify_url' => $notify_url,
            'order_id' => $order_id,
            'items' => $items,
            'currency' => $currency,
            'amount' => $amount,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'hash' => $hash,
        ];

        $payment_url = 'https://sandbox.payhere.lk/pay/checkout';

        if (env('PAYHERE_MODE') === 'live') {
            $payment_url = 'https://www.payhere.lk/pay/checkout';
        }

        return view('payment.payment', ['payment_data' => $payment_data, 'payment_url' => $payment_url]);
    }

    public function paymentSuccess(Request $request)
    {
        $enrolmentId = $request->enrolment_id;

        $enrollment = Enrollment::find($enrolmentId);

        if ($enrollment) {
            $enrollment->Next_Payment_Date = Carbon::parse($enrollment->Next_Payment_Date)->addDays(30);
            $enrollment->save();

            $pay = new StudentPayment();
            $pay->payment_date = Carbon::now();
            $pay->amount = '250.00';
            $pay->enrolment_id = $enrolmentId;
            $pay->save();
        } else {
            return response()->json(['error' => 'Enrollment not found'], 404);
        }

        return redirect()->route('view-enrollment')->with('success', 'Payment processed successfully!');
    }

    public function paymentNotify(Request $request)
    {
        $order_id = $request->input('order_id');
        $status_code = $request->input('status_code');
        $md5sig = $request->input('md5sig');

        // Verify the MD5 signature
        $merchant_id = env('PAYHERE_MERCHANT_ID');
        $amount = $request->input('payhere_amount');
        $currency = $request->input('payhere_currency');
        $secret = strtoupper(md5(env('PAYHERE_SECRET')));

        $local_md5sig = strtoupper(md5($merchant_id . $order_id . $amount . $currency . $status_code . $secret));

        if ($md5sig === $local_md5sig) {
            // Handle the payment status update
            if ($status_code == 2) {
                // Payment successful
                // Update your order status in the database
                // $order = Order::where('order_id', $order_id)->first();
                // if ($order) {
                //     $order->status = 'paid';
                //     $order->save();
                // }
            }
        }

        return response('OK', 200);
    }

    public function ViewStudentsPayments()
    {
        $payments = DB::table('student_payments')
            ->join('enrollments', 'student_payments.enrolment_id', '=', 'enrollments.id')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->select(
                'student_payments.*',
                'students.FullName',
                'subjects.subject_name',
                'enrollments.Next_Payment_Date',
                'grades.Grade',
            )
            ->orderBy('created_at', 'DESC')->get();

            

        return view('Admin.stPayments', compact('payments'));
    }

    public function getPayments(Request $request)
    {
        $startDate = $request->input('startdate');
        $endDate = $request->input('enddate');

        $payments = DB::table('student_payments')
            ->join('enrollments', 'student_payments.enrolment_id', '=', 'enrollments.id')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->select(
                'student_payments.*',
                'students.FullName',
                'subjects.subject_name',
                'enrollments.Next_Payment_Date',
                'grades.Grade'
            )
            ->orderBy('created_at', 'DESC')
            ->whereBetween('student_payments.payment_date', [$startDate, $endDate])
            // ->where('student.fullname',$studentname) example 
            ->get();

        return response()->json($payments);
    }

    public function PrintStudentPayments(Request $request)
    {
        $startDate = $request->startdate;
        $endDate = $request->enddate;

        $payments = DB::table('student_payments')
            ->join('enrollments', 'student_payments.enrolment_id', '=', 'enrollments.id')
            ->join('students', 'enrollments.student_id', '=', 'students.id')
            ->join('subject_mappings', 'enrollments.subject_id', '=', 'subject_mappings.id')
            ->join('subjects', 'subject_mappings.subject_id', '=', 'subjects.id')
            ->join('grades', 'subject_mappings.grade_id', '=', 'grades.id')
            ->select(
                'student_payments.*',
                'students.FullName',
                'subjects.subject_name',
                'enrollments.Next_Payment_Date',
                'grades.Grade'
            )
            ->orderBy('created_at', 'DESC')
            ->whereBetween('student_payments.payment_date', [$startDate, $endDate])
            ->get();

        $pdf = PDF::loadView('pdf.studentpayment', compact('payments', 'startDate', 'endDate'));

        return $pdf->download('StudentPayment.pdf');
    }

    public function ViewTeachersPayments()
    {
        $payments = DB::table('teacher_payments')
            ->join('teachers', 'teacher_payments.teacher_id', '=', 'teachers.id')
            ->select(
                'teacher_payments.*',
                'teachers.full_name'
            )
            ->orderBy('created_at', 'DESC')->get();

        return view('Admin.TeachersPayments', compact('payments'));
    }

    public function getTeachersPayments(Request $request){
        $startDate = $request->input('startdate');
        $endDate = $request->input('enddate');

        $payments = DB::table('teacher_payments')
        ->join('teachers', 'teacher_payments.teacher_id', '=', 'teachers.id')
        ->select(
            'teacher_payments.*',
            'teachers.full_name'
        )
        ->orderBy('created_at', 'DESC')->whereBetween('teacher_payments.month', [$startDate, $endDate])->get();

        return response()->json($payments);
    }

    public function PrintTeachersPayments(Request $request)
    {
        $startDate = $request->startdate;
        $endDate = $request->enddate;

        $payments = DB::table('teacher_payments')
        ->join('teachers', 'teacher_payments.teacher_id', '=', 'teachers.id')
        ->select(
            'teacher_payments.*',
            'teachers.full_name'
        )
        ->orderBy('created_at', 'DESC')->whereBetween('teacher_payments.month', [$startDate, $endDate])->get();

        $pdf = PDF::loadView('pdf.teacherpay', compact('payments', 'startDate', 'endDate'));

        return $pdf->download('Teacher salaries.pdf');
    }

    public function UpdatePayments($id){
        $enrolment = DB::table('enrollments')->where('id', $id)->first();
        return view('payment.payhere', compact('enrolment'));
    }
}
