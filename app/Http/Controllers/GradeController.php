<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //
    public function Save(Request $request){
        $request->validate([
            'gradename' => 'required|string|max:255'
        ]);

        $grades = new Grade();
        $grades->Grade = $request->input('gradename');
        $grades->save();

        return redirect()->back()->with('success', 'Subject registered successfully!');
    }

    public function View(){
        $grades = Grade::all();
        return view('Admin.Grade', compact('grades'));
    }
}
