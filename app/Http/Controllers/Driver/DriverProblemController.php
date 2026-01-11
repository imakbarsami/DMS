<?php

namespace App\Http\Controllers\Driver;

use App\Driver;
use App\DriverProblem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverProblemController extends Controller
{
    public function create($id){
        $driver=Driver::findOrFail($id);
        return view('drivers.problem.create',compact('driver'));
    }


    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'driver_id'       => 'required|exists:drivers,id',
            'vehicle_number'  => 'required',
            'type'            => 'required',
            'severity'        => 'required',
            'occurrence_date' => 'required|date',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $input = $request->all();
        $input['occurrence_date'] = date('Y-m-d H:i:s', strtotime($request->occurrence_date));

        // Image Upload Logic
        if ($image = $request->file('proof_image')) {
            $destinationPath = 'problems/'; 
            $imageName = date('YmdHis') . "_proof." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $imageName);
            $input['proof_image'] = $imageName;
        }

        DriverProblem::create($input);

        return redirect()->route('drivers.show', $request->driver_id)
                        ->with('success', 'Problem reported successfully.')
                        ->with('active_tab', 'history');
    }



    public function show($id)
    {
        $problem = DriverProblem::with('driver')->findOrFail($id);
        return view('drivers.problem.show', compact('problem'));
    }

    public function edit($id)
    {
        $problem = DriverProblem::with('driver')->findOrFail($id);
        return view('drivers.problem.edit', compact('problem'));
    }


    public function update(Request $request, $id)
    {
        $problem = DriverProblem::findOrFail($id);

        // 1. Validation
        $request->validate([
            'vehicle_number'  => 'required',
            'type'            => 'required',
            'occurrence_date' => 'required', 
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $input = $request->all();

        if($request->has('occurrence_date')){
             $input['occurrence_date'] = date('Y-m-d H:i:s', strtotime($request->occurrence_date));
        }

        // Image Update Logic
        if ($image = $request->file('proof_image')) {
            $destinationPath = 'problems/';
            
            // Delete old image if exists
            if ($problem->proof_image && file_exists(public_path($destinationPath . $problem->proof_image))) {
                unlink(public_path($destinationPath . $problem->proof_image));
            }

            $imageName = date('YmdHis') . "_proof." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $imageName);
            $input['proof_image'] = $imageName;
        } else {
            unset($input['proof_image']);
        }

        // Update Record
        $problem->update($input);

        // Redirect to Report View
        return redirect()->route('driver-problems.show', $problem->id)
                        ->with('success', 'Report updated successfully.');
    }

    public function destroy($id)
    {
        $problem = DriverProblem::findOrFail($id);

        // Delete Image file
        if ($problem->proof_image && file_exists(public_path('problems/' . $problem->proof_image))) {
            unlink(public_path('problems/' . $problem->proof_image));
        }

        $driver_id = $problem->driver_id;
        
        $problem->delete();

        return redirect()->route('drivers.show', $driver_id)
                        ->with('success', 'Record deleted successfully')
                        ->with('active_tab', 'history');
    }
}
