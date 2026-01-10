<?php

namespace App\Http\Controllers\Driver;

use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers=Driver::latest()->paginate(10);
        return view('drivers.index',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Rhtml @hasSection()
    
@endifesponse
     */
    public function create()
    {
        return view('drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:drivers',
            'license_number' => 'required|unique:drivers',
            'dob' => 'required|date|before:-18 years',
            
            // Image Validations
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'driving_license_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'nid_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();
        $destinationPath = 'images/';

        // 1. Profile Image Upload
        if ($image = $request->file('image')) {
            $profileName = date('YmdHis') . "_profile." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileName);
            $input['image'] = $profileName;
        }

        // 2. Driving License Image Upload
        if ($dl_image = $request->file('driving_license_img')) {
            $dlName = date('YmdHis') . "_dl." . $dl_image->getClientOriginalExtension();
            $dl_image->move(public_path($destinationPath), $dlName);
            $input['driving_license_img'] = $dlName;
        }

        // 3. NID Image Upload
        if ($nid_image = $request->file('nid_img')) {
            $nidName = date('YmdHis') . "_nid." . $nid_image->getClientOriginalExtension();
            $nid_image->move(public_path($destinationPath), $nidName);
            $input['nid_img'] = $nidName;
        }

        Driver::create($input);
        return redirect()->route('drivers.index')->with('success','Driver created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        return view('drivers.show',compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Driver::find($id);
        return view('drivers.edit',compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Driver $driver)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:drivers,phone,'.$driver->id, 
            'nid_number' => 'required|unique:drivers,nid_number,'.$driver->id,
            'dob' => 'required|date|before:-18 years',
            'license_number' => 'required|unique:drivers,license_number,'.$driver->id,
            'blood_group' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'driving_licence_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'nid_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
        ],[
            'dob.before' => 'The driver must be at least 18 years old.',
            'blood_group.required' => 'Select a blood group.',
        ]);
  
        $input = $request->all();
  
        // Image Logic
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            if($driver->image && file_exists(public_path($destinationPath . $driver->image))){
                unlink(public_path($destinationPath . $driver->image));
            }

            // New Image Upload
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $profileImage;
        } else {
            unset($input['image']);
        }


        // Nid Image Logic
        if ($image = $request->file('nid_img')) {
            $destinationPath = 'nid/';
            if($driver->nid_img && file_exists(public_path($destinationPath . $driver->nid_img))){
                unlink(public_path($destinationPath . $driver->nid_img));
            }

            // New Image Upload
            $nidImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $nidImage);
            $input['nid_img'] = $nidImage;
        } else {
            unset($input['nid_img']);
        }


        // Image Logic
        if ($image = $request->file('driving_licence_img')) {
            $destinationPath = 'driving-licences/';
            if($driver->driving_licence_img && file_exists(public_path($destinationPath . $driver->driving_licence_img))){
                unlink(public_path($destinationPath . $driver->driving_licence_img));
            }

            // New Image Upload
            $drivingLicenceImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $drivingLicenceImage);
            $input['driving_licence_img'] = $drivingLicenceImage;
        } else {
            unset($input['driving_licence_img']);
        }

       
          
        // 3. Update Database
        $driver->update($input);
    
        return redirect()->route('drivers.index')
                        ->with('success','Driver updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        // Delete Image if exists
        $destinationPath = 'images/';
        
        if($driver->image && file_exists(public_path($destinationPath . $driver->image))){
            unlink(public_path($destinationPath . $driver->image));
        }

        // Delete Database Record
        $driver->delete();
     
        return redirect()->route('drivers.index')
                        ->with('success','Driver deleted successfully');
    }
}
