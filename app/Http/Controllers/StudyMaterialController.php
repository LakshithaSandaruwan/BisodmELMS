<?php

namespace App\Http\Controllers;

use App\Models\StudyMaterial;
use Illuminate\Http\Request;

class StudyMaterialController extends Controller
{
    //
    public function Save(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,ppt|max:5048'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('matirials', 'public');

            $materials = new StudyMaterial();
            $materials->File_Path = $filePath;
            $materials->Name = $request->name;
            $materials->subject_id = $request->input('subject_id');
            $materials->save();

            return redirect()->back()->with('success', 'Material saved successfully.');
        }

        return redirect()->back()->with('error', 'There was an issue saving the Material.');
    }

    public function ViewMaterials($id){
        $studyMaterials = StudyMaterial::where('subject_id', $id)->get();

        return view('Student.Materials', compact('studyMaterials'));
    }
}
