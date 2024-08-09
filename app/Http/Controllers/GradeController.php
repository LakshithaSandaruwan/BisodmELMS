<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //
    public function Save(Request $request)
    {
        $request->validate([
            'gradename' => 'required|string|max:255'
        ]);

        $grades = new Grade();
        $grades->Grade = $request->input('gradename');
        $grades->save();

        return redirect()->back()->with('success', 'Subject registered successfully!');
    }

    public function View()
    {
        $grades = Grade::all();
        return view('Admin.Grade', compact('grades'));
    }

    public function delete($id)
    {
        $grade = Grade::find($id);
        if ($grade) {
            $grade->delete();
            return redirect()->back()->with('success', 'Grade deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Grade not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Grade' => 'required|string|max:255',
        ]);

        $grade = Grade::find($id);
        if ($grade) {
            $grade->Grade = $request->input('Grade');
            $grade->save();
            return redirect()->back()->with('success', 'Grade updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Grade not found.');
        }
    }
}
