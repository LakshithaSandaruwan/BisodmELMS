<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function Register(Request $request){
        $request->validate([
            'Initial' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'FullName' => 'required|string|max:255',
            'Gender' => 'required|string|max:255',
            'birthday' => 'required|date',
            'school' => 'required|string|max:255',
            'City' => 'required|string|max:255',
            'Grade' => 'required|string|max:255',
            'ContactNumber' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'HouseNumber' => 'nullable|string|max:255',
            'StreetAdress' => 'required|string|max:255',
            'District' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'ParentFullName' => 'required|string|max:255',
            'ParentGender' => 'required|string|max:255',
            'ParentBirthday' => 'required|date',
            'NIC' => 'required|string|max:255',
            'PNumber' => 'required|string|max:255',
            'Pemail' => 'required|email|max:255',
        ]);

        Student::create([
            'initial' => $request->Initial,
            'LastName' => $request->LastName,
            'FullName' => $request->FullName,
            'Gender' => $request->Gender,
            'birthday' => $request->birthday,
            'school' => $request->school,
            'city' => $request->City,
            'grade' => $request->Grade,
            'contactNumber' => $request->ContactNumber,
            'email' => $request->Email,
            'houseNumber' => $request->HouseNumber,
            'street' => $request->StreetAdress,
            'district' => $request->District,
            'province' => $request->province,
            'PerentFullName' => $request->ParentFullName,
            'PerentGender' => $request->ParentGender,
            'PerentNic' => $request->NIC,
            'PerentContact' => $request->PNumber,
            'PerentEmail' => $request->Pemail,
        ]);

        return redirect()->back()->with('success', 'Student registered successfully!');
    }
}
