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

    public function BatchEdit(Request $request){
        
        $request->validate([
            'batch' => 'required|string|max:255',
            'startdate' => 'required|date',
            'enddate' => 'required|date'
        ]);

        $batch = Batch::find($request->batchid);
        if($batch){
            $batch->Year = $request->input('batch');
            $batch->Startdate = $request->input('startdate');
            $batch->EndDate = $request->input('enddate');
            $batch->save();
            return redirect()->back()->with('success','Batch update successfully');
        }else{
            return redirect()->back()->with('error','Batch not found');
        }
    }
}
