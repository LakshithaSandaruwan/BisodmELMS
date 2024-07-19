<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    //
    public function view(){
        $batchs = Batch::all();
        return view('Admin.Batch', compact('batchs'));
    }

    public function Save(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'startDate' => 'required',
            'endtDate' => 'required'
        ]);

        $batch = new Batch();
        $batch->Year = $request->input('name');
        $batch->StartDate = $request->input('startDate');
        $batch->EndDate = $request->input('endtDate');
        $batch->save();

        return redirect()->back()->with('success', 'Batch registered successfully!');
    }
}
