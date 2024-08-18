<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;

class FeedbackController extends Controller
{
    public function FeedbackSave(Request $request){

        $request->validate([
            'subject'=> 'required|string|max:255',
            'feedbacktext'=> 'required|string|max:500'
        ]);

        $userid=Auth::id();
        $studentid=Student::where('user_id',$userid)->pluck('id')->first();

        $sub = $request->subject;
        
        $feedback= new Feedback();
        $feedback->Subject = $sub;
        $feedback->Feedback = $request->feedbacktext;
        $feedback->student_id = $studentid;
        $feedback->save();

        return redirect()->back()->with('success', 'Feedback saved!');

    }
}
