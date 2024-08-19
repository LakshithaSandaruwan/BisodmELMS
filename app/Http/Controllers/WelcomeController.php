<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcomepage(){
        $feedbacks = Feedback::select('feedback.*','students.fullname')
        ->join('students','feedback.student_id','students.id')
        ->get();
        return view('welcome',compact('feedbacks'));
    }
}
