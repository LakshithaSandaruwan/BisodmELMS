<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\TeacherPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'T_NIC' => 'required|string|max:12', // Adjust max length as per your needs
            'study_qulification' => 'nullable|string|max:255',
            'T_number' => 'required|string|max:15',
            'T_email' => 'required|email|max:255',
            'T_housenumber' => 'nullable|string|max:255',
            'T_streetaddress' => 'nullable|string|max:255',
            'T_district' => 'nullable|string|max:255',
            'T_province' => 'nullable|string|max:255',
        ]);
        
        $randomPassword = Str::random(12);

        $user = new User();
        $user->name = $request->input('teacher_Lastname');
        $user->email = $request->input('T_email');
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
        $teacher->email = $request->input('T_email');
        $teacher->houseNumber = $request->input('T_housenumber');
        $teacher->street = $request->input('T_streetaddress');
        $teacher->district = $request->input('T_district');
        $teacher->province = $request->input('T_province');
        $teacher->user_id = $user->id;

        $teacher->save();

        Mail::to($user->email)->send(new TeacherPasswordEmail($user->name, $randomPassword));

        return redirect()->back()->with('success', 'Teacher registered successfully!');
    }
}
